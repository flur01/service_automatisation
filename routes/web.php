<?php

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

Route::get('/','MainPageController@view_main_page')
->name('main-page');

Route::get('/get-json','MainPageController@get_json');

Route::get('/add-form', 'AddFormController@view_add_form')
->name('add-form');

Route::post('/add-form', 'AddFormController@add_gadget')
->name('add-gadget');

Route::get('/add-form/get-json', 'AddFormController@get_json_product_name');

Route::get('/add-product-list','AddProductListController@view_add_form_product_list')
->name('add-form-product-list');

Route::post('/add-product-list', 'AddProductListController@store')
->name('to-add-product-list');

Route::get('/change-password','ChangeAdminPasswordController@view_change_password_form')
->name('change-password-form');

Route::post('/change-password', 'ChangeAdminPasswordController@change_password')
->name('change-password');

Auth::routes([
    'register' => true,
    'verify' => true,
    'reset' => false
]);
