<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\RoomController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

Route::middleware('auth:sanctum')->get("/chat/rooms", [ChatController::class, "rooms"])->name("chat.rooms");
Route::middleware('auth:sanctum')->get("/chat/room/{roomId}/messages", [ChatController::class, "messages"])->name("chat.messages");
Route::middleware('auth:sanctum')->post("/chat/room/{roomId}/message", [ChatController::class, "newMessage"])->name("chat.newMessage");

Route::middleware('auth:sanctum')->get("/myrooms", [RoomController::class, "index"]);
Route::middleware('auth:sanctum')->post("/addroom", [RoomController::class, "store"]);
Route::middleware('auth:sanctum')->delete("/deleteroom/{id}", [RoomController::class, "destroy"]);

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])
->get('/chat', function () {
    return Inertia::render('Chat/Container');
})->name('chat');
