<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/сategories', [\App\Http\Controllers\Taxonomy\TaxonomyController::class, 'fetchTaxonnomies']);
Route::get('/сategories/{id}', [\App\Http\Controllers\Taxon\TaxonController::class, 'getTaxon']);
Route::get('/сategories/{id}/products', [\App\Http\Controllers\Product\ProductController::class, 'getProductsByCategory']);
