<?php

use App\Http\Controllers\API\LandingPageController;
use App\Http\Controllers\API\RegionController;
use App\Http\Controllers\API\SubCategoryController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get("/", [LandingPageController::class, "index"])->name("landing-page");

$routes = glob(__DIR__ . "/api/*.php");
foreach ($routes as $route) require($route);

// Sub Category Created Apis
Route::post('/subcategories', [SubCategoryController::class, 'store']);
Route::put('subcategories/{subcategory}', [SubCategoryController::class, 'update']);
Route::delete('subcategories/{subcategory}', [SubCategoryController::class, 'destroy']);
