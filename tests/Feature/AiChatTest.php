<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class AiChatTest extends TestCase
{
    public function test_chat_returns_a_clear_error_when_gemini_is_not_configured(): void
    {
        config(['services.gemini.key' => null]);

        Http::fake();

        $this->postJson(route('ai.chat'), ['message' => 'Надад хувцас санал болго'])
            ->assertServiceUnavailable()
            ->assertJsonStructure(['message']);

        Http::assertNothingSent();
    }

    public function test_chat_sends_catalog_and_conversation_to_gemini(): void
    {
        config([
            'services.gemini.key' => 'test-api-key',
            'services.gemini.model' => 'gemini-test-model',
        ]);

        Http::fake([
            'generativelanguage.googleapis.com/*' => Http::response([
                'candidates' => [[
                    'content' => ['parts' => [['text' => 'Өдөр тутам өмсөх хувцас санал болгоё.']]],
                ]],
            ]),
        ]);

        $this->postJson(route('ai.chat'), [
            'message' => 'Өдөр тутмын look санал болго',
            'language' => 'mn',
            'history' => [
                ['role' => 'user', 'content' => 'Би хар өнгөнд дуртай'],
                ['role' => 'assistant', 'content' => 'Ямар occasion-д өмсөх вэ?'],
            ],
        ])->assertOk()
            ->assertJson(['reply' => 'Өдөр тутам өмсөх хувцас санал болгоё.']);

        Http::assertSent(function ($request): bool {
            return $request->hasHeader('x-goog-api-key', 'test-api-key')
                && str_contains($request->url(), 'gemini-test-model:generateContent')
                && $request['contents'][0]['role'] === 'user'
                && $request['contents'][1]['role'] === 'model'
                && $request['contents'][2]['parts'][0]['text'] === 'Өдөр тутмын look санал болго'
                && str_contains($request['systemInstruction']['parts'][0]['text'], 'Zara');
        });
    }

    public function test_chat_validates_message_and_limits_history(): void
    {
        config(['services.gemini.key' => 'test-api-key']);

        $this->postJson(route('ai.chat'), [
            'message' => str_repeat('x', 2001),
            'history' => array_fill(0, 11, ['role' => 'user', 'content' => 'Hello']),
        ])->assertUnprocessable()
            ->assertJsonValidationErrors(['message', 'history']);
    }

    public function test_chat_reports_gemini_service_failures(): void
    {
        config(['services.gemini.key' => 'test-api-key']);

        Http::fake([
            'generativelanguage.googleapis.com/*' => Http::response(['error' => 'Unavailable'], 503),
        ]);

        $this->postJson(route('ai.chat'), ['message' => 'Зөвлөгөө өгнө үү'])
            ->assertStatus(502)
            ->assertJsonStructure(['message']);
    }
}
