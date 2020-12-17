<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TwitterController;
use App\Http\Controllers\FacebookController;

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
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('login/facebook', [FacebookController::class,     'redirectToProvider'])->name('facebook-login');
    Route::get('login/facebook/callback', [FacebookController::class, 'handleProviderCallback'])->name('facebook-callback');
    Route::get('login/twitter', [TwitterController::class,      'redirectToProvider'])->name('twitter-login');
    Route::get('login/twitter/callback', [TwitterController::class,  'handleProviderCallback'])->name('twitter-callback');
});

require __DIR__ . '/auth.php';
