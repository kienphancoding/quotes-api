<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\ProfessionController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\TopicController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('profession')->group(function () {
    Route::get('/', [ProfessionController::class, "index"]);
    Route::get('/{id}', [ProfessionController::class, "show"]);
    Route::get('/order', [ProfessionController::class, "order"]);
    Route::post('/', [ProfessionController::class, "create"]);
    Route::put('/{id}', [ProfessionController::class, "update"]);
});

Route::prefix('topic')->group(function () {
    Route::get('/', [TopicController::class, "index"]);
    Route::get('/{id}', [TopicController::class, "show"]);
    Route::get('/order', [TopicController::class, "order"]);
    Route::post('/', [TopicController::class, "create"]);
    Route::put('/{id}', [TopicController::class, "update"]);
});

Route::prefix('author')->group(function () {
    Route::get('/', [AuthorController::class, "index"]);
    Route::get('/{id}', [AuthorController::class, "singleRead"]);
    Route::get('/order', [AuthorController::class, "order"]);
    Route::get('/jobs/{path}', [AuthorController::class, "profession"]);
    Route::post('/', [AuthorController::class, "create"]);
    Route::put('/{id}', [AuthorController::class, "update"]);
});

Route::prefix('quote')->group(function () {
    Route::get('/', [QuoteController::class, "index"]);
    Route::get('/author/{path}', [QuoteController::class, "author"]);
    Route::get('/topic/{path}', [QuoteController::class, "topic"]);
    Route::get('/search', [QuoteController::class, "search"]);
    Route::get('/random', [QuoteController::class, "random"]);
    Route::get('/{id}', [QuoteController::class, "show"]);
    Route::post('/', [QuoteController::class, "create"]);
    Route::put('/{id}', [QuoteController::class, "update"]);
    Route::delete('/{id}', [QuoteController::class, "delete"]);
});
