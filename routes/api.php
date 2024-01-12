<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\NewsController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\HighlightController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\CoursesController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => '{lang}', 'middleware' => 'langMiddleware'], function () {
    Route::group(["prefix"=> "/news"], function () {
        Route::get('/', [NewsController::class, 'index']);
        Route::get('/{slug}', [NewsController::class, 'show']);
    });
    Route::group(["prefix"=> "/school"], function () {
        Route::get('/', [SchoolController::class, 'index']);
        Route::get('/{slug}', [SchoolController::class, 'show']);
    });
    Route::group(["prefix"=> "/teams"], function () {
        Route::get('/{slug}', [SchoolController::class, 'teams']);
    });
    Route::group(["prefix"=> "/project"], function () {
        Route::get('/', [ProjectsController::class, 'index']);
        Route::get('/{slug}', [ProjectsController::class, 'show']);
    });
    Route::group(["prefix"=> "/testimonial"], function () {
        Route::get('/', [TestimonialController::class, 'index']);
        Route::get('/{slug}', [TestimonialController::class, 'show']);
    });
    Route::group(["prefix"=> "/highlight"], function () {
        Route::get('/', [HighlightController::class, 'index']);
        Route::get('/{slug}', [HighlightController::class, 'show']);
    });
    Route::group(["prefix"=> "/agenda"], function () {
        Route::get('/', [AgendaController::class, 'index']);
        Route::get('/{slug}', [AgendaController::class, 'show']);
    });
    Route::group(["prefix"=> "/courses"], function () {
        Route::get('/', [CoursesController::class, 'index']);
        Route::get('/{slug}', [CoursesController::class, 'show']);
    });
});
