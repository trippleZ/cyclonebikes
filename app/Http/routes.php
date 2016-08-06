<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::auth();

Route::get('/', 'HomeController@index');

Route::get('/about', 'HomeController@about');

Route::get('/news', 'HomeController@news');

Route::get('/news/{name}', 'HomeController@newsOne');

Route::get('/contacts', function() {

    return view('content.contacts');

});

Route::get('/warranty', function() {

    return view('content.warranty');

});

Route::get('/dilers', function() {

    return view('content.dilers');

});

Route::get('/bikes', 'HomeController@all');

Route::get('/bikes/{type}', 'HomeController@types')->where('type', '[a-z]+');

Route::get('/bikes/{type}/{name}/{size}', 'HomeController@bike')->where('type', '[a-z]+');

Route::group(['prefix' => 'admin'], function() {

    Route::get('/', 'AdminController@index');

    Route::get('/add', 'AdminController@add');

    Route::get('/delete/{id}', 'AdminController@delete');

    Route::get('/edit/{id}', 'AdminController@edit');

    Route::post('/save', 'AdminController@update');

    Route::post('/deleteattr', 'AdminController@deleteAttr');

    Route::post('/deletecolor', 'AdminController@deleteColor');

    Route::post('/newcolor', 'AdminController@newColor');

    Route::post('/update/{id}', 'AdminController@update');

    Route::group(['prefix' => '/type'], function() {

        Route::get('/', 'AdminController@showTypes');

        Route::get('/edit/{id}', 'AdminController@typeEdit');

        Route::post('/update/{id}', 'AdminController@typeUpdate');

        Route::get('/delete/{id}', 'AdminController@typeDelete');

        Route::get('/add', function() {

            return view('admin.add_type');

        });

        Route::post('/save', 'AdminController@typeUpdate');

    });

    Route::group(['prefix' => '/parts'], function() {

        Route::get('/', 'AdminController@showParts');

        Route::get('/edit/{id}', 'AdminController@partEdit');

        Route::post('/update/{id}', 'AdminController@partUpdate');

        Route::get('/delete/{id}', 'AdminController@partDelete');

        Route::get('/add', function() {

            return view('admin.add_part');

        });

        Route::post('/save', 'AdminController@partUpdate');

    });

    Route::group(['prefix' => '/carousel'], function() {

        Route::get('/', 'AdminController@carousel');

        Route::get('/{img}/delete', 'AdminController@carouselDelete');

        Route::post('/add', 'AdminController@carouselAdd');

    });

    Route::group(['prefix' => '/news'], function() {

        Route::get('/', 'AdminController@news');

        Route::get('/delete/{id}', 'AdminController@deleteNews');

        Route::post('/save', 'AdminController@updateNews');

        Route::post('/update/{id}', 'AdminController@updateNews');

        Route::get('/edit/{id}', 'AdminController@editNews');

        Route::get('/add', function() {

            return view('admin.add_news');

        });

    });

});
