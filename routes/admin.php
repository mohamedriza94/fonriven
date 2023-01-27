<?php
use Illuminate\Support\Facades\Route;
Route::group([
    'prefix'=>'admin', 
    'namespace'=>'App\Http\Controllers\Admin', 
    'middleware'=>['web']
], function(){
    Route::get('/', 'Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('/', 'Auth\LoginController@validateLogin')->name('admin.login.submit');
    Route::group(['middleware' => ['auth:admin']], function () {
        Route::post('/logout', 'Auth\LoginController@logout')->name('admin.logout');
        Route::group(['prefix' => 'dashboard'], function () {
            
            //page routes
            Route::get('/', 'DashboardController@index')->name('admin.dashboard');
            Route::get('supplier', 'DashboardController@supplierRequest')->name('admin.supplierRequest');

            //supplier requests route
            Route::get('getRequests/{limit}', 'SupplierRequestController@getRequests');
            Route::post('takeActionToRequest', 'SupplierRequestController@takeActionToRequest');
            Route::get('viewRequest/{id}', 'SupplierRequestController@viewRequest');
        });
    });
});