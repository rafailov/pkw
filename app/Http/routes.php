<?php

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');
Route::get('/about', 'AboutController@index');
Route::post('/about', 'PostsController@store');
Route::get('/services', 'ServiceController@index');
Route::get('/careers', 'CareerController@index');
Route::get('/careers/{career_id}', 'ApplicationsController@index');
Route::post('/careers/{career_id}', 'ApplicationsController@store');
Route::get('/contacts', 'ContactsController@index');
Route::post('/contacts', 'ContactsController@store');


Route::group(array('middleware' => 'auth'), function () {
    Route::get('/admin', 'HomeController@adminIndex');

    Route::get('/admin/slider', 'SliderController@indexAdmin');
    Route::get('/admin/slider/create', 'SliderController@create');
    Route::post('/admin/slider/create', 'SliderController@store');
    Route::get('/admin/slider/edit/{slider_id}', 'SliderController@edit');
    Route::post('/admin/slider/edit', 'SliderController@update');
    Route::post('/admin/slider/destroy', 'SliderController@destroy');
    Route::get('/admin/slider/switch/{value}', 'SliderController@switchSlider');

    Route::get('/admin/about', 'AboutController@adminIndex');
    Route::post('/admin/about', 'AboutController@update');

    Route::get('/admin/service', 'ServiceController@indexAdmin');
    Route::get('/admin/service/create', 'ServiceController@create');
    Route::post('/admin/service/create', 'ServiceController@store');
    Route::get('/admin/service/edit/{service_id}', 'ServiceController@edit');
    Route::post('/admin/service/edit', 'ServiceController@update');
    Route::post('/admin/service/destroy', 'ServiceController@destroy');


    Route::get('/admin/products/{service_id?}', 'ProductListController@indexAdmin');
    Route::get('/admin/product/create/{service_id?}', 'ProductListController@create');
    Route::post('/admin/product/create', 'ProductListController@store');
    Route::get('/admin/product/edit/{product_id}/{service_id}', 'ProductListController@edit');
    Route::post('/admin/product/edit', 'ProductListController@update');
    Route::post('/admin/product/destroy', 'ProductListController@destroy');

    Route::get('/admin/mails', 'ContactsController@adminIndex');
    Route::post('/admin/mails/destroy', 'ContactsController@destroyMeil');

    Route::get('/admin/posts', 'PostsController@adminIndex');
    Route::post('/admin/posts/approve', 'PostsController@approve');
    Route::post('/admin/posts/reject', 'PostsController@reject');
    Route::post('/admin/posts/destroy', 'PostsController@destroy');

    Route::get('/admin/careers', 'CareerController@indexAdmin');
    Route::get('/admin/career/create', 'CareerController@create');
    Route::post('/admin/career/create', 'CareerController@store');
    Route::get('/admin/career/edit/{career_id}', 'CareerController@edit');
    Route::post('/admin/career/edit', 'CareerController@update');
    Route::post('/admin/career/destroy', 'CareerController@destroy');

    Route::get('/admin/contacts', 'ContactsController@adminContactView');
    Route::get('/admin/contact/create', 'ContactsController@createContact');
    Route::post('/admin/contact/create', 'ContactsController@storeContact');
    Route::get('/admin/contact/edit/{contact_id}', 'ContactsController@editContacts');
    Route::post('/admin/contact/edit', 'ContactsController@updateContacts');
    Route::post('/admin/contact/destroy', 'ContactsController@destroyContact');

    Route::get('/admin/applications', 'ApplicationsController@adminIndex');
    Route::post('/admin/applications/destroy', 'ApplicationsController@destroy');
    Route::get('/uploads/cv/{app_cv}', 'ApplicationController@downloadCV');


});

Route::get('auth/login', 'AdminController@returnLoginView');
Route::post('auth/login', 'AdminController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::get('/getRegisterForm', function () {
    return view('admin.register');
});







