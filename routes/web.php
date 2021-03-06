<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TorahController;
use App\Http\Controllers\NeviimController;
use App\Http\Controllers\TorahChapterController;
use App\Http\Controllers\TorahVerseController;
use App\Http\Controllers\NeviimChapterController;
use App\Http\Controllers\NeviimVerseController;
use App\Http\Controllers\KetuvimController;
use App\Http\Controllers\KetuvimChapterController;
use App\Http\Controllers\KetuvimVerseController;

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

Route::group(['prefix' => '/web', 'middleware' => ['auth', 'verified']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::group(['prefix' => '/manager'], function () {
        Route::get('/divisions', [DashboardController::class, 'managerDivisions']);

        Route::group(['prefix' => '/torah'], function () {
            Route::get('/books', [TorahController::class, 'managerBooks']);
            Route::get('/books/{id}/chapters', [TorahChapterController::class, 'managerChapters']);
            Route::get('/books/{id}/chapters/{chapterId}/verses', [TorahVerseController::class, 'managerVerses']);
        });

        Route::group(['prefix' => '/neviim'], function () {
            Route::get('/books', [NeviimController::class, 'managerBooks']);
            Route::get('/books/{id}/chapters', [NeviimChapterController::class, 'managerChapters']);
            Route::get('/books/{id}/chapters/{chapterId}/verses', [NeviimVerseController::class, 'managerVerses']);
        });

        Route::group(['prefix' => '/ketuvim'], function () {
            Route::get('/books', [KetuvimController::class, 'managerBooks']);
            Route::get('/books/{id}/chapters', [KetuvimChapterController::class, 'managerChapters']);
            Route::get('/books/{id}/chapters/{chapterId}/verses', [KetuvimVerseController::class, 'managerVerses']);
        });
    });

    Route::group(['prefix' => '/torah'], function () {
        Route::group(['prefix' => '/{bookId}'], function () {
            Route::post('/chapters/{chapterId}/verses', [TorahVerseController::class, 'store']);
            Route::put('/chapters/{chapterId}/verses/{id}', [TorahVerseController::class, 'update']);
            Route::delete('/chapters/{chapterId}/verses/{id}', [TorahVerseController::class, 'destroy']);    
        });
    
        Route::group(['prefix' => '/{bookId}'], function () {
            Route::post('/chapters/', [TorahChapterController::class, 'store']);
            Route::put('/chapters/{id}', [TorahChapterController::class, 'update']);
            Route::delete('/chapters/{id}', [TorahChapterController::class, 'destroy']);
    
        });
    
        Route::post('/', [TorahController::class, 'store']);
        Route::put('/{id}', [TorahController::class, 'update']);
        Route::delete('/{id}', [TorahController::class, 'destroy']);
    });
    
    Route::group(['prefix' => '/neviim'], function () {
        Route::group(['prefix' => '/{bookId}'], function () {
            Route::post('/chapters/{chapterId}/verses', [NeviimVerseController::class, 'store']);
            Route::put('/chapters/{chapterId}/verses/{id}', [NeviimVerseController::class, 'update']);
            Route::delete('/chapters/{chapterId}/verses/{id}', [NeviimVerseController::class, 'destroy']);    
        });
    
        Route::group(['prefix' => '/{bookId}'], function () {
            Route::post('/chapters/', [NeviimChapterController::class, 'store']);
            Route::put('/chapters/{id}', [NeviimChapterController::class, 'update']);
            Route::delete('/chapters/{id}', [NeviimChapterController::class, 'destroy']);
    
        });
    
        Route::post('/', [NeviimController::class, 'store']);
        Route::put('/{id}', [NeviimController::class, 'update']);
        Route::delete('/{id}', [NeviimController::class, 'destroy']);
    });
    
    Route::group(['prefix' => '/ketuvim'], function () {
        Route::group(['prefix' => '/{bookId}'], function () {
            Route::post('/chapters/{chapterId}/verses', [KetuvimVerseController::class, 'store']);
            Route::put('/chapters/{chapterId}/verses/{id}', [KetuvimVerseController::class, 'update']);
            Route::delete('/chapters/{chapterId}/verses/{id}', [KetuvimVerseController::class, 'destroy']);    
        });
    
        Route::group(['prefix' => '/{bookId}'], function () {
            Route::post('/chapters/', [KetuvimChapterController::class, 'store']);
            Route::put('/chapters/{id}', [KetuvimChapterController::class, 'update']);
            Route::delete('/chapters/{id}', [KetuvimChapterController::class, 'destroy']);
    
        });
    
        Route::post('/', [KetuvimController::class, 'store']);
        Route::put('/{id}', [KetuvimController::class, 'update']);
        Route::delete('/{id}', [KetuvimController::class, 'destroy']);
    }); 
});

require __DIR__.'/auth.php';
