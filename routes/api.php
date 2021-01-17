<?php

use App\Cart\Actions\IndexCartAction;
use App\Cart\Actions\StoreCartAction;
use App\Cart\Actions\DeleteCartAction;
use App\Cart\Actions\UpdateCartAction;
use App\Users\Actions\LoginUserAction;
use App\Users\Actions\RegisterUserAction;
use App\Products\Actions\ShowProductAction;
use App\Products\Actions\IndexProductsAction;
use App\Users\Actions\AuthenticatedUserAction;
use App\Addresses\Actions\IndexAddressesAction;
use App\Addresses\Actions\StoreAddressesAction;
use App\Categories\Actions\IndexCategoriesAction;

Route::middleware('auth:api')->get('/user', AuthenticatedUserAction::class);
Route::get('/categories', IndexCategoriesAction::class);
Route::get('/products', IndexProductsAction::class);

Route::group(['prefix' => 'auth', 'middleware' => 'guest:api'], function () {
    Route::post('/register', RegisterUserAction::class);
    Route::post('/login', LoginUserAction::class);
});

Route::group(['middleware' => ['auth:api']], function () {
    Route::post('/cart', StoreCartAction::class);
    Route::get('cart', IndexCartAction::class);
    Route::put('cart/{productVariation}', UpdateCartAction::class);
    Route::delete('cart/{productVariation}', DeleteCartAction::class);
    Route::get('addresses', IndexAddressesAction::class);
    Route::post('addresses', StoreAddressesAction::class);
});

Route::get('/products/{product}', ShowProductAction::class);
