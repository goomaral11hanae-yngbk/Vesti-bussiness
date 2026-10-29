<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class AiChatController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'message' => ['required', 'string', 'max:2000'],
            'language' => ['nullable', Rule::in(['mn', 'en'])],
            'history' => ['sometimes', 'array', 'max:10'],
            'history.*.role' => ['required', Rule::in(['user', 'assistant'])],
            'history.*.content' => ['required', 'string', 'max:2000'],
        ]);

        $apiKey = config('services.gemini.key');

        if (! is_string($apiKey) || trim($apiKey) === '') {
            return response()->json([
                'message' => 'Gemini AI тохируулагдаагүй байна. GEMINI_API_KEY тохируулна уу.',
            ], 503);
        }

        $catalog = collect(config('vesti.items'))
            ->map(fn (array $products, string $brand) => $brand.': '.implode(', ', $products))
            ->implode("\n");

        $history = collect($validated['history'] ?? [])
            ->map(fn (array $turn) => [
                'role' => $turn['role'] === 'assistant' ? 'model' : 'user',
                'parts' => [['text' => $turn['content']]],
            ])
            ->all();

        $history[] = [
            'role' => 'user',
            'parts' => [['text' => $validated['message']]],
        ];

        $language = ($validated['language'] ?? 'mn') === 'en' ? 'English' : 'Mongolian';

        try {
            $response = Http::withHeaders([
                'x-goog-api-key' => $apiKey,
            ])->timeout(25)->post(
                'https://generativelanguage.googleapis.com/v1beta/models/'
                    .config('services.gemini.model', 'gemini-2.5-flash')
                    .':generateContent',
                [
                    'systemInstruction' => [
                        'parts' => [[
                            'text' => "You are VESTI, a friendly fashion stylist. Reply in {$language}. "
                                .'Help users discover their personal color direction, coordinate outfits, '
                                .'and choose clothing. Be warm, practical, concise, and ask one useful '
                                .'follow-up question when preferences are unclear. Explain that color '
                                .'season advice is an informal style guide, not a scientific assessment. '
                                ."Recommend only products in this VESTI catalog; do not invent stock, "
                                ."prices, delivery details, or claim an order was placed:\n{$catalog}",
                        ]],
                    ],
                    'contents' => $history,
                    'generationConfig' => [
                        'maxOutputTokens' => 700,
                        'temperature' => 0.7,
                    ],
                ]
            );
        } catch (ConnectionException $exception) {
            Log::warning('Gemini AI request could not connect.', [
                'exception' => $exception::class,
            ]);

            return response()->json([
                'message' => 'AI үйлчилгээтэй холбогдож чадсангүй. Түр хүлээгээд дахин оролдоно уу.',
            ], 502);
        }

        if (! $response->successful()) {
            Log::warning('Gemini AI request failed.', [
                'status' => $response->status(),
            ]);

            return response()->json([
                'message' => 'AI хариу өгөхөд алдаа гарлаа. Дахин оролдоно уу.',
            ], 502);
        }

        $answer = collect($response->json('candidates.0.content.parts', []))
            ->pluck('text')
            ->filter(fn ($text) => is_string($text) && trim($text) !== '')
            ->implode("\n");

        if ($answer === '') {
            Log::warning('Gemini AI returned no text content.');

            return response()->json([
                'message' => 'AI хариу үүсгэж чадсангүй. Өөрөөр асуугаад үзнэ үү.',
            ], 502);
        }

        return response()->json(['reply' => $answer]);
    }
}
