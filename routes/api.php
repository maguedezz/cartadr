<?php

use App\Users\Actions\LoginUserAction;
use App\Users\Actions\RegisterUserAction;
use App\Products\Actions\ShowProductAction;
use App\Products\Actions\IndexProductsAction;
use App\Users\Actions\AuthenticatedUserAction;
use App\Categories\Actions\IndexCategoriesAction;

Route::middleware('auth:api')->get('/user', AuthenticatedUserAction::class);
Route::get('/categories', IndexCategoriesAction::class);
Route::get('/products', IndexProductsAction::class);

Route::group(['prefix' => 'auth', 'middleware' => 'guest:api'], function () {
    Route::post('/register', RegisterUserAction::class);
    Route::post('/login', LoginUserAction::class);
});

// Route::group(['middleware' => ['auth:api']], function () {
//     Route::post('cart', IndexCartAction::class);
// });

Route::get('/products/{product}', ShowProductAction::class);
