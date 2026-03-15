<?php

use Illuminate\Support\Facades\Route;
// use Mail;
// use DB;

// Controllers
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChildCategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SponsoredVendorController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ManagePartnerController;
use App\Http\Controllers\ImportantDocsController;
use App\Http\Controllers\TicketCategoryController;


// Partner Panel
use App\Http\Controllers\Partnerpanel\PartnerPanelController;

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

// use App\Mail\SubscriberMail;
// Route::get('mass-registration', function () {
//     // return view('emails.subscribers');
// 	$mailArrs = DB::table('temp_subscribers')->where('sent', 0)->select('email')->take(2)->get();
// // 	dd($mailArrs);
// 	$emails = [];
// 	foreach($mailArrs as $mailArr) {
// 	    $emails[] = $mailArr->email;
// 	   // DB::table('temp_subscribers')->insertGetId([
// 	   //     'email'=>$mailArr['email']
// 	   //]);
// 	}
		
// 	if(!empty($emails)) {
// 	    Mail::to('info@ubidindia.com')
//             ->bcc($emails)
//             ->send(new SubscriberMail());
    
//         if(!Mail::failures()) {
//             DB::table('temp_subscribers')->whereIn('email', $emails)->update(['sent'=>1]);
//         }
// 	}
    
//     die('Mail Sent');
// });

Route::get('/', function () {
    return redirect()->route('register');
});

// Ajax routes

Route::any('register', [AuthController::class, 'register'])->name('register');


Route::any('sendVendorOtp', [AuthController::class, 'sendVendorOtp'])->name('sendVendorOtp');
Route::any('verifyOtp', [AuthController::class, 'verifyOtp'])->name('verifyOtp');
Route::any('login', [AuthController::class, 'login'])->name('login');
Route::any('raiseIssue', [AuthController::class, 'raiseIssue'])->name('raiseIssue');
Route::any('forgot-password', [AuthController::class, 'forgotPassword'])->name('forgotPassword');
Route::any('registerDetails', [AuthController::class, 'registerDetails'])->name('registerDetails');
Route::any('subscriptionDetails', [AuthController::class, 'subscriptionDetails'])->name('subscriptionDetails');
Route::any('profile_review', [AuthController::class, 'profile_review'])->name('profile_review');
Route::any('resendOtp', [AuthController::class, 'resendOtp'])->name('resendOtp');
//update details in vendor list from admin panel
Route::any('updateDetails', [AuthController::class, 'updateDetails'])->name('updateDetails');
Route::any('privacypolicy', [AuthController::class, 'privacypolicy'])->name('privacypolicy');
Route::any('vendoragreement', [AuthController::class, 'vendoragreement'])->name('vendoragreement');
Route::any('termsandconditions', [AuthController::class, 'termsandconditions'])->name('termsandconditions');
Route::any('getcitiesbystate', [AuthController::class, 'getcitiesbystate'])->name('getcitiesbystate');
Route::any('getcities', [AuthController::class, 'getcities'])->name('getcities');


Route::any('clienttestimonial/{ref_id}',[AuthController::class, 'clienttestimonial'])->name('clienttestimonial');
Route::any('submitfeedback',[AuthController::class, 'submitfeedback'])->name('submitfeedback');




// After login routes
Route::group([
    'middleware' => 'auth'
], function ($router) {

    // Accounts
    Route::get('dashboard', [AccountController::class, 'dashboard'])->name('dashboard');
    Route::any('change-password', [AuthController::class, 'changePassword'])->name('changePassword');
    Route::any('logout', [AccountController::class, 'logout'])->name('logout');
    Route::get('notifications',[AccountController::class, 'notifications'])->name('notifications');

    // ********************************************************** //
    // ******************  Category Management  ***************** //
    // ********************************************************** //


    Route::group([
        'prefix' => 'category',
    ], function () {
        Route::get('', [CategoryController::class, 'index'])->name('category');
        Route::any('getcategoryajaxlistdata', [CategoryController::class, 'getcategoryajaxlistdata'])->name('category.getcategoryajaxlistdata');
        Route::get('addEditCategory', [CategoryController::class, 'addEditCategory'])->name('category.addEditCategory');
        Route::post('add', [CategoryController::class, 'create'])->name('category.create');
        Route::post('update', [CategoryController::class, 'update'])->name('category.update');
        Route::any('delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');
    });

    Route::group([
        'prefix' => 'childcategory',
    ], function () {
        Route::get('', [ChildCategoryController::class, 'index'])->name('childcategory');
        Route::any('getchildcategoryajaxlistdata', [ChildCategoryController::class, 'getchildcategoryajaxlistdata'])->name('childcategory.getchildcategoryajaxlistdata');
        Route::get('addEditSubCategory', [ChildCategoryController::class, 'addEditSubCategory'])->name('childcategory.addEditSubCategory');
        Route::post('add', [ChildCategoryController::class, 'create'])->name('childcategory.create');
        Route::post('update', [ChildCategoryController::class, 'update'])->name('childcategory.update');
        Route::any('delete/{id}', [ChildCategoryController::class, 'delete'])->name('childcategory.delete');
    });

    Route::group([
        'prefix' => 'ticketcategory',
    ], function () {
        Route::get('', [TicketCategoryController::class, 'index'])->name('ticketcategory');
        Route::any('getcategoryajaxlistdata', [TicketCategoryController::class, 'getcategoryajaxlistdata'])->name('ticketcategory.getcategoryajaxlistdata');
        Route::get('addEditTicketCategory', [TicketCategoryController::class, 'addEditTicketCategory'])->name('ticketcategory.addEditTicketCategory');
        Route::post('add', [TicketCategoryController::class, 'create'])->name('ticketcategory.create');
        Route::post('update', [TicketCategoryController::class, 'update'])->name('ticketcategory.update');
        Route::any('delete/{id}', [TicketCategoryController::class, 'delete'])->name('ticketcategory.delete');
    });

    // ********************************************************** //
    // ******************  Customer Management  ***************** //
    // ********************************************************** //
    Route::group([
        'prefix' => 'customer',
    ], function () {
        Route::get('', [CustomerController::class, 'index'])->name('customer');
        Route::any('update', [CustomerController::class, 'update'])->name('customer.update');
        Route::any('getcustomerajaxlistdata', [CustomerController::class, 'getcustomerajaxlistdata'])->name('customer.getcustomerajaxlistdata');
        Route::any('editCustomer', [CustomerController::class, 'editCustomer'])->name('customer.editCustomer');
        Route::any('delete/{id}', [CustomerController::class, 'delete'])->name('customer.delete');
        Route::any('changeStatus', [CustomerController::class, 'changeStatus'])->name('customer.changeStatus');
    });

    // ********************************************************* //
    // ******************  Profile Management  ***************** //
    // ********************************************************* //
    Route::group([
        'prefix' => 'profile',
    ], function () {
        Route::get('', [ProfileController::class, 'index'])->name('profile');
    });

    // ******************************************************* //
    // ******************  Sponsored Vendors ***************** //
    // ******************************************************* //
    Route::group([
        'prefix' => 'vendors',
    ], function () {
        Route::get('', [SponsoredVendorController::class, 'index'])->name('vendors');
    });

    // ************************************************************* //
    // ******************  Subscription Management ***************** //
    // ************************************************************* //
    Route::group([
        'prefix' => 'subscription',
    ], function () {
        Route::get('', [SubscriptionController::class, 'index'])->name('subscription');
        Route::any('getsubscriptionajaxlistdata', [SubscriptionController::class, 'getsubscriptionajaxlistdata'])->name('subscription.getsubscriptionajaxlistdata');
        Route::post('add', [SubscriptionController::class, 'add'])->name('subscription.add');
        Route::post('update', [SubscriptionController::class, 'update'])->name('subscription.update');
        Route::any('getsubscription', [SubscriptionController::class, 'getsubscription'])->name('subscription.getsubscription');

    });

    Route::group([
        'prefix' => 'subscribers',
    ], function () {
        Route::get('', [SubscriberController::class, 'index'])->name('subscriber');
        Route::any('getsubscriberajaxlistdata', [SubscriberController::class, 'getsubscriberajaxlistdata'])->name('subscriber.getsubscriberajaxlistdata');
    });

    // ************************************************************* //
    // ******************  Ticket Management ***************** //
    // ************************************************************* //
    Route::group([
        'prefix' => 'ticket',
    ], function () {
        Route::get('', [TicketController::class, 'index'])->name('ticket');
        Route::any('message', [TicketController::class, 'message'])->name('ticket.message');
        Route::get('manage/{id}',[TicketController::class, 'editTicket'])->name('ticket.manage');
        Route::any('postComment/{id}',[TicketController::class, 'postComment'])->name('ticket.postComment');
        Route::any('getticketajaxlistdata', [TicketController::class, 'getticketajaxlistdata'])->name('ticket.getticketajaxlistdata');
        Route::any('changestatus', [TicketController::class, 'changestatus'])->name('ticket.changestatus');
        Route::any('reopen/{id}', [TicketController::class, 'reopen'])->name('ticket.reopen');
        Route::any('close/{id}', [TicketController::class, 'close'])->name('ticket.close');
    });

    // ******************************************************************* //
    // ******************  Bussiness Partner Management  ***************** //
    // ******************************************************************* //
    Route::group([
        'prefix' => 'partner',
    ], function () {
        Route::get('', [PartnerController::class, 'index'])->name('partner');
        Route::any('getvendorajaxlistdata', [PartnerController::class, 'getvendorajaxlistdata'])->name('partner.getvendorajaxlistdata');
        Route::any('managepartner', [PartnerController::class, 'managePartners'])->name('partner.manage');
        Route::any('view', [PartnerController::class, 'view'])->name('partner.view');
        Route::any('acceptpartner/{id}', [PartnerController::class, 'acceptPartner'])->name('partner.accept');
        Route::any('rejectpartner/{id}', [PartnerController::class, 'rejectPartner'])->name('partner.reject');
        Route::any('holdpartner', [PartnerController::class, 'holdpartner'])->name('partner.hold');
        Route::any('partnerdetails/{id}', [PartnerController::class, 'partnerdetails'])->name('partner.partnerdetails');


    });

    Route::group([
        'prefix' => 'managepartner',
    ], function () {
        Route::get('', [ManagePartnerController::class, 'index'])->name('managepartner');
        Route::any('getvendorajaxlistdata', [ManagePartnerController::class, 'getvendorajaxlistdata'])->name('managepartner.getvendorajaxlistdata');
        Route::any('view/{id}', [ManagePartnerController::class, 'view'])->name('managepartner.view');
        Route::any('update/{id}', [ManagePartnerController::class, 'update'])->name('managepartner.update');
    });

    // ********************************************* //
    // ******************  Important Documents  ***************** //
    // ********************************************* //
    Route::group([
        'prefix' => 'importantdocs',
    ], function () {
        Route::get('',[ImportantDocsController::class, 'index'])->name('importantdocs');
        Route::any('getAjaxListData',[ImportantDocsController::class, 'getAjaxListData'])->name('importantdocs.getAjaxListData');
        Route::any('add',[ImportantDocsController::class, 'add'])->name('importantdocs.add');
        Route::any('edit/{id}',[ImportantDocsController::class, 'edit'])->name('importantdocs.edit');
        Route::any('view/{id}',[ImportantDocsController::class, 'view'])->name('importantdocs.view');
        Route::any('changeStatus', [ImportantDocsController::class, 'changeStatus'])->name('importantdocs.changeStatus');

    });



});


Route::group([
    'middleware' => 'auth'
], function ($router) {


    // ******************************************************* //
    // ******************  Partner Panel ***************** //
    // ******************************************************* //
    Route::group([
        'as' => 'ppanel.',
    ], function () {
        Route::get('placebids', [PartnerPanelController::class, 'placeBids'])->name('placebids');
        Route::get('mybids', [PartnerPanelController::class, 'myBids'])->name('mybids');
        Route::get('support', [PartnerPanelController::class, 'support'])->name('support');
        Route::get('wishlist', [PartnerPanelController::class, 'wishlist'])->name('wishlist');
        Route::get('vprofile', [PartnerPanelController::class, 'vprofile'])->name('vprofile');
        Route::get('testimonials', [PartnerPanelController::class, 'testimonials'])->name('testimonials');
        Route::any('requesttestimonial', [PartnerPanelController::class, 'requesttestimonial'])->name('requesttestimonial');
        Route::get('details/{id}', [PartnerPanelController::class, 'details'])->name('details');
        Route::get('biddetails/{id}', [PartnerPanelController::class, 'bidDetails'])->name('biddetails');
        Route::any('vendorRaiseTicket', [PartnerPanelController::class, 'vendorRaiseTicket'])->name('vendorRaiseTicket');
        Route::any('updatebasicdetail', [PartnerPanelController::class, 'updatebasicdetail'])->name('updatebasicdetail');
        Route::any('updateadditionaldetail', [PartnerPanelController::class, 'updateadditionaldetail'])->name('updateadditionaldetail');
        Route::any('addcategory', [PartnerPanelController::class, 'addcategory'])->name('addcategory');
        Route::any('addprojectimage',[PartnerPanelController::class, 'addprojectimage'])->name('addprojectimage');
        Route::any('uploadproject',[PartnerPanelController::class, 'uploadproject'])->name('uploadproject');
        Route::any('uploadprojectimage',[PartnerPanelController::class, 'uploadprojectimage'])->name('uploadprojectimage');
        Route::any('updateprojectimage',[PartnerPanelController::class, 'updateprojectimage'])->name('updateprojectimage');
        Route::any('deletecategory/{id}',[PartnerPanelController::class,'deletecategory'])->name('deletecategory');
        Route::any('deleteprojectimage/{id}',[PartnerPanelController::class,'deleteprojectimage'])->name('deleteprojectimage');
        Route::any('getprojectimages',[PartnerPanelController::class,'getprojectimages'])->name('getprojectimages');
        Route::any('deleteproject/{id}',[PartnerPanelController::class, 'deleteproject'])->name('deleteproject');
        Route::any('vendorRaiseTicket',[PartnerPanelController::class,'vendorRaiseTicket'])->name('vendorRaiseTicket');
        Route::any('getsubcategories',[PartnerPanelController::class,'getsubcategories'])->name('getsubcategories');
        Route::any('getprojectdetails',[PartnerPanelController::class,'getprojectdetails'])->name('getprojectdetails');
        Route::get('setwishlist/{rid}', [PartnerPanelController::class, 'setwishlist'])->name('setwishlist');
        Route::get('removewishlist/{wid}', [PartnerPanelController::class, 'removewishlist'])->name('removewishlist');
        Route::any('submitbid',[PartnerPanelController::class, 'submitbid'])->name('submitbid');
        Route::any('changepassword', [PartnerPanelController::class, 'changepassword'])->name('changepassword');
        Route::get('notification',[PartnerPanelController::class, 'notification'])->name('notification');
        Route::get('conversation/{id}',[PartnerPanelController::class, 'conversation'])->name('conversation');
        Route::any('postcomment/{id}',[PartnerPanelController::class, 'postcomment'])->name('postcomment');
        Route::any('ticketreopen/{id}',[PartnerPanelController::class, 'ticketreopen'])->name('ticketreopen');
        Route::get('getbidstatus',[PartnerPanelController::class,'getbidstatus'])->name('getbidstatus');
        Route::get('customerinfo',[PartnerPanelController::class,'customerinfo'])->name('customerinfo');

    });
});
