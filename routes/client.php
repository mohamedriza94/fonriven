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
            Route::get('getProductCount/{id}', 'ProductController@getProductCount');
            Route::get('getProductsForView/{id}', 'ProductController@getProductsForView');
            
            //supplier management
            Route::get('getTrendingSuppliers', 'SupplierController@getTrendingSuppliers');
            Route::get('getSupplier', 'SupplierController@getSupplier');
            Route::get('categorizeSupplier/{category}', 'SupplierController@categorizeSupplier');
            Route::get('getOneSupplier/{id}', 'SupplierController@getOneSupplier');

            //connections
            Route::post('makeConnection', 'ConnectionController@makeConnection');
            Route::get('viewConnections', 'ConnectionController@viewConnections');
            Route::get('searchConnections/{search}', 'ConnectionController@searchConnections');
            Route::get('viewOneConnection/{connectionNo}', 'ConnectionController@viewOneConnection');
            Route::post('endConnection', 'ConnectionController@endConnection');
            Route::post('rating', 'ConnectionController@rating');

            //messages
            Route::post('composeMessage', 'MessageController@composeMessage');
            Route::get('getMessages/{type}', 'MessageController@getMessages');
            Route::get('getEntity/{no}', 'MessageController@getEntity');
            Route::delete('deleteMessage', 'MessageController@deleteMessage');
            Route::get('getOneMessage/{id}', 'MessageController@getOneMessage');
            Route::post('reply', 'MessageController@reply');
            
        });
    });
});