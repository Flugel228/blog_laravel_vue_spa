<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::group(['namespace' => 'App\Http\Controllers\API\User', 'prefix' => 'users'], function () {
    Route::post('/', 'StoreController');
});

Route::group(['namespace' => 'App\Http\Controllers\API'], function () {

    Route::group(['namespace' => 'Post', 'middleware' => 'throttle:500,1', 'prefix' => 'posts'], function () {
        Route::post('/', 'IndexController');
        Route::post('/categories', 'CategoryController');
        Route::post('/{post}', 'ShowController');

        Route::group(['namespace' => 'Comment', 'prefix' => '{post}/comments'], function () {
            Route::post('/', 'IndexController');
            Route::post('/store', 'StoreController');
        });

        Route::group(['namespace' => 'Like', 'prefix' => '{post}/likes'], function () {
            Route::post('/store', 'StoreController');
        });
    });

    Route::group(['namespace' => 'AdminPanel', 'prefix' => 'admin', 'middleware' => 'admin'], function () {

       Route::group(['namespace' => 'Tag', 'prefix' => 'tags'], function () {
           Route::post('/', 'IndexController');
           Route::post('/store', 'StoreController');
           Route::post('/{tag}', 'IndexController');
           Route::put('/{tag}', 'UpdateController');
           Route::delete('/{tag}','DestroyController');
       });

        Route::group(['namespace' => 'Category', 'prefix' => 'categories'], function () {
            Route::post('/', 'IndexController');
            Route::post('/store', 'StoreController');
            Route::post('/{category}', 'IndexController');
            Route::put('/{category}', 'UpdateController');
            Route::delete('/{category}','DestroyController');
        });

        Route::group(['namespace' => 'Post', 'prefix' => 'posts'], function () {
            Route::post('/', 'IndexController');
            Route::post('/store', 'StoreController')->name('api.admin.post.store');
            Route::post('/{post}', 'IndexController');
            Route::patch('/{post}', 'UpdateController')->name('api.admin.post.update');
            Route::delete('/{post}','DestroyController');
        });

        Route::group(['namespace' => 'User', 'prefix' => 'users'], function () {
            Route::post('/', 'IndexController');
            Route::post('/store', 'StoreController');
            Route::post('/{user}', 'IndexController');
            Route::patch('/{user}', 'UpdateController');
            Route::delete('/{user}','DestroyController');
        });
    });
});


Route::group(['namespace' => 'App\Http\Controllers\API', 'middleware' => 'api', 'prefix' => 'auth'], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

    Route::group(['middleware' => 'jwt.auth'], function () {
        Route::group(['namespace' => 'User'], function () {
           Route::group(['namespace' => 'Like', 'prefix' => 'likes'], function () {
               Route::post('/', 'IndexController');
               Route::post('/categories', 'CategoryController');
           });
           Route::group(['namespace' => 'Comment', 'prefix' => 'comments'], function () {
              Route::post('/', 'IndexController');
           });
        });
    });
});
