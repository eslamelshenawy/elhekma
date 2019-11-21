<?php

use Illuminate\Http\Request;

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

Admin::registerAuthRoutes();

    /***************************************************************
     * Password Reset
     ***************************************************************/
     Route::group(['prefix' => 'password'], function() {
        Route::post('/reset', 'Api\ResetPasswordController@reset');
        Route::post('/sendResetPasswordMobile', 'Api\ForgotPasswordController@sendResetPasswordMobile');
    });






    Route::post('register', 'Api\CustomerController@register');
    Route::post('login', 'Api\CustomerController@login');
    Route::get('getStates', 'Api\HomeController@getStates');
    Route::get('getCities', 'Api\HomeController@getCities');

Route::group(['middleware' => ['CheckActivationMobile', 'auth:customer-api'],'namespace' =>'Api'], function () {

    Route::get('get_departments','DepartmentController@get_all_departments');
    Route::get('getProfile', 'CustomerController@getProfile');
    Route::post('editProfile', 'CustomerController@editProfile');
    Route::post('changePassword', 'CustomerController@changePassword');
    Route::get('get_home','HomeController@get_home');
    Route::post('search','SearchController@search');
    Route::get('get_product_by_id','ProductController@get_product_by_id');
    Route::get('get_product_review','ProductController@get_product_review');
    Route::post('add_product_review','ProductController@add_product_review');
    Route::post('add_favorite','FavoriteController@add_favorite');
    Route::get('get_favorite','FavoriteController@get_favorite');
    Route::post('remove_favorite','FavoriteController@remove_favorite');
    Route::get('faq', 'HomeController@faq');
    Route::get('setting', 'HomeController@setting');
    Route::get('get_stories', 'HomeController@get_stories');
    Route::get('get_contact_detail', 'HomeController@get_contact_detail');
    Route::get('getTargetAudience' , 'SearchController@getTargetAudience');
    Route::get('getSpecialist' , 'SearchController@getSpecialist');
    Route::get('getPharmaceuticalForm' , 'SearchController@getPharmaceuticalForm');
    Route::get('getOrders', 'OrderController@getOrders');
    Route::post('cancelOrderid', 'OrderController@deleteOrderid');
    Route::get('trackOrder', 'OrderController@trackOrder');
    Route::get('getPrescriptions', 'PrescriptionController@getPrescriptions');
    Route::post('uploadPrescription', 'PrescriptionController@uploadPrescription');
    Route::post('addToCart', 'OrderController@addToCart');
    Route::post('confirmCart', 'OrderController@ConfirmCart');
    Route::get('removeFromCart', 'OrderController@removeFromCart');
    Route::get('getCart', 'OrderController@getCart');
    Route::post('updateCart', 'OrderController@updateCart');
    Route::post('checkout', 'OrderController@checkout');
    Route::post('checkAvailability', 'OrderController@checkAvailability');
    Route::get('GetTypeRemind', 'RemindController@gettype');
    Route::post('medicationRemind', 'RemindController@medicationRemind');
    Route::post('settingRemind', 'RemindController@settingRemind');
    Route::post('addreminderwaters', 'RemindController@addreminderwaters');
    Route::get('getreminderwaters', 'RemindController@getreminderwaters');
    Route::get('getreminderfood', 'RemindController@getreminderfood');
    Route::post('addreminderfood', 'RemindController@addreminderfood');
    Route::post('addreminderexercise', 'RemindController@addreminderexercise');
    Route::post('addbloodpressure', 'RemindController@addbloodpressure');
    Route::post('addheart', 'RemindController@addheart');
    Route::post('addbloodsugar', 'RemindController@addbloodsugar');
    Route::post('addweightmeasure', 'RemindController@addweight');
    Route::post('addheightmeasure', 'RemindController@addheight');


});

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

