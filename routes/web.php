<?php

use App\Http\Controllers\AiChatController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Buh huudas (brand, baraa, AI) ni JS hash-router-eer (#zara, #zara-3) ajillana
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/ai/chat', AiChatController::class)->middleware('throttle:10,1')->name('ai.chat');