<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return response()->json(['API' => 'OK']);
});


Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', 'Api\AuthController@login')->name('login');
    Route::post('register', 'Api\AuthController@register')->name('register');
    Route::post('resendOtp', 'Api\AuthController@resendOtp')->name('resendOtp');
    Route::post('verifyOtpRegister', 'Api\AuthController@verifyOtpRegister')->name('verifyOtpRegister');
    Route::post('verifyOtpLogin', 'Api\AuthController@verifyOtpLogin')->name('verifyOtpLogin');

    Route::group(['middleware' => ['auth:api']], function () {
        Route::post('logout', 'Api\AuthController@logout')->name('logout');
        Route::post('refresh', 'Api\AuthController@refresh')->name('refresh');
        Route::get('profile', 'Api\AuthController@profile')->name('profile');
        Route::put('updateProfile', 'Api\AuthController@updateProfile')->name('updateProfile');
        Route::get('getcategorysbyname', 'Api\CategoryController@getCategorysByNameandLocation')->name('getcategorysbyname');
        Route::get('getalllocations', 'Api\CategoryController@getAllLocations')->name('getalllocations');

        Route::get('getallcategorys', 'Api\CategoryController@getAllcategorysandSubcategorys')->name('getallcategorys');
        Route::get('gettopdesigners', 'Api\VendorDesignController@getTopVendors')->name('gettopdesigners');
        Route::get('getalldesigns', 'Api\CategoryController@getAllDesigns')->name('getalldesigns');
        Route::get('getdesigndetailbyvendorid', 'Api\VendorDesignController@getDesignDetailsByVendor')->name('getdesigndetailbyvendorid');
        Route::get('getvendordetailsbyid', 'Api\VendorDesignController@getVendorDetailsByVendorId')->name('getvendordetailsbyid');
        Route::get('getbannerimages', 'Api\VendorDesignController@getBannerImages')->name('getbannerimages');
        Route::get('getcustomernotification', 'Api\CustomerController@getNotificationlist')->name('getcustomernotification');
        Route::post('updateuserprofile', 'Api\CustomerController@updateUserProfile')->name('updateuserprofile');
        Route::get('getcustomerbids', 'Api\CustomerController@customerAllBids')->name('getcustomerbids');
        Route::get('getbidsacceptedbyvendor', 'Api\CustomerController@getBidsAcceptedByVendor')->name('getbidsacceptedbyvendor');
        Route::post('bidacceptbycustomer', 'Api\CustomerController@AcceptBidByCusomerRequest')->name('bidacceptbycustomer');
        Route::get('getcustomerenquires', 'Api\CustomerController@getCustomerEnquires')->name('getcustomerenquires');
        Route::get('getvendordesignbydesignid', 'Api\CategoryController@getVendorDesignById')->name('getvendordesignbydesignid');
        Route::post('requirementssave', 'Api\CustomerController@customerRequirementsSave')->name('requirementssave');
        Route::post('enquiresave', 'Api\CustomerController@enquireSave')->name('enquiresave');
        Route::get('getallvendordesignsbycategory', 'Api\VendorDesignController@getAllVendorDesignsByCategory')->name('getallvendordesignsbycategory');
        Route::post('addrating', 'Api\VendorDesignController@Addrating')->name('addrating');
        Route::get('getratingbyvendor', 'Api\VendorDesignController@getratingbyVendor')->name('getratingbyvendor');      
        
        
    });
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
