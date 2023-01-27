<?php
use Illuminate\Support\Facades\Route;


Route::get('/', 'App\Http\Controllers\Client\DashboardController@index');

Route::group([
    'prefix'=>'client', 
    'namespace'=>'App\Http\Controllers\Client', 
    'middleware'=>['web']
], function(){
    Route::get('/', 'DashboardController@index')->name('client.login');
    Route::post('login', 'Auth\LoginController@validateLogin')->name('client.login.submit');
    
    //sign up as buyer or supplier
    Route::post('signupBuyer', 'ClientController@createBuyerAccount');
    Route::post('signupSupplier', 'ClientController@createSupplierRequest');
    
    Route::group(['middleware' => ['auth:client']], function () {
        Route::post('/logout', 'Auth\LoginController@logout')->name('client.logout');
        Route::group(['prefix' => 'dashboard'], function () {
            Route::get('/', 'DashboardController@index')->name('client.dashboard');
            Route::post('editAccount', 'ClientController@editAccount');

            Route::get('connections', 'DashboardController@connections')->name('client.connections');
            Route::get('products', 'DashboardController@products')->name('client.products');
            Route::get('messages', 'DashboardController@messages')->name('client.messages');
            Route::get('suppliers', 'DashboardController@suppliers')->name('client.suppliers');

            //product management
            Route::post('addProduct', 'ProductController@addProduct');
            Route::get('getProduct/{limit}', 'ProductController@getProduct');
            Route::get('searchProduct/{search}', 'ProductController@searchProduct');
            Route::post('changeStatus', 'ProductController@changeStatus');
            Route::delete('deleteProduct', 'ProductController@deleteProduct');
            Route::get('getOneProduct/{id}', 'ProductController@getOneProduct');
            Route::get('getTags/{product}', 'ProductController@getTags');
            Route::delete('deleteTag', 'ProductController@deleteTag');
            Route::post('updateProduct', 'ProductController@updateProduct');

            //supplier management
            Route::get('getSupplier', 'SupplierController@getSupplier');
            Route::get('searchSupplier/{search}', 'SupplierController@searchSupplier');
            Route::get('getOneSupplier/{id}', 'SupplierController@getOneSupplier');
        });
    });
});