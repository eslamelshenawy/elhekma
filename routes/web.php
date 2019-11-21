<?php
use App\Http\Middleware\CheckActivation;
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
Route::get('/clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    Artisan::call('cache:clear');
    return "Cache is cleared";
});
Route::get('/','HomeController@index')->name('home');

Route::get('/about-us', 'HomeController@aboutUs')->name('aboutUs');
Route::get('/page/{id}', 'HomeController@page')->name('page');
Route::get('/cart','OrderController@cartPage')->name('cartPage');
Route::post('/cart/{action}','OrderController@actionCart')->name('actionCart');
Route::get('/checkout','OrderController@checkout')->name('checkout');
Route::post('/checkout','OrderController@submitCheckout')->name('submitCheckout');
Route::post('/checkout/checkOutlets','OrderController@checkOutlets')->name('checkOutlets');
Route::get('/compare', 'HomeController@compare')->name('compare');
Route::get('/contact-us', 'HomeController@contactUs')->name('contactUs');
Route::post('/contact-us', 'HomeController@submit_contactUs')->name('submit.contactUs');
Route::get('search/{slug}','MedicineController@medicinePage')->name('medicine.Page');
Route::get('/auto_complete_products/{name_en}','MedicineController@ajaxAutoCompeleteProducts');
Route::post('/search/{slug}','MedicineController@search')->name('search.product');
Route::get('/auto_complete_companies/{name_en}','MedicineController@ajaxAutoCompeleteCompanies');
Route::get('search_product_header','HomeController@search_product_header')->name('search_product');
Route::post('add_review','ReviewController@add_review')->name('addReview');
Route::get('add_favorite','FavoriteController@add_favorite')->name('updateFavorite');

Route::get('/places', 'CustomerController@places')->name('places');
Route::post('/subscribe', 'HomeController@subscribe')->name('subscribe.email');
Route::get('/login', 'CustomerController@loginPage')->name('login');
Route::get('/verify/{activation_code}', 'CustomerController@verify')->name('verify');
Route::post('/submitLogin', 'CustomerController@submitLogin')->name('submitLogin');
Route::get('/register','CustomerController@registerPage')->name('register');
Route::post('/submitRegister','CustomerController@register')->name('submitRegister');
Route::get('forgotPassword','CustomerController@forgotPasswordPage')->name('forgotPassword');

Route::get('/shop-grid', function () {
    return view('shop-grid');
});
Route::get('/store','OrderController@storePage')->name('storePage');
Route::get('/track-order','OrderController@trackOrderPage')->name('trackOrder');
Route::post('/track-order/filter','OrderController@filterOrders')->name('filterOrders');
Route::post('/track-order/cancel','OrderController@cancelOrder')->name('cancelOrder');
Route::get('/track-order/reorder/{id}','OrderController@reorder')->name('reorder');
Route::get('/wishlist', 'CustomerController@wishlist')->name('wishlist');
Route::get('/terms-conditions', 'HomeController@terms')->name('terms');
Route::get('/single-product', 'HomeController@singleProduct')->name('singleProduct');
Route::get('/single-blog-left-sidebar', function () {
    return view('single-blog-left-sidebar');
});
Route::get('/prescription/','PrescriptionController@prescriptionHistory')->name('prescriptionHistory');
Route::get('/prescription/upload','PrescriptionController@showUploadPrescription')->name('showUploadPrescription');
Route::post('/prescription/upload','PrescriptionController@uploadPrescription')->name('uploadPrescription');

Route::get('/feature', 'HomeController@feature')->name('feature');
Route::get('/faq', 'HomeController@faq')->name('faq');
Route::get('/blog-1-column-left-sidebar', function () {
    return view('blog-1-column-left-sidebar');
});
Route::get('/best-deals', function () {
    return view('best-deals');
});


Route::get('category','CategoryController@depends');

Route::get('pharmaTag/{id}','PharmaTagController@pharma_tag');

Route::get('brand','BrandController@depends');
Route::get('importExcel','BrandController@importExcel');
Route::get('company','CustomFieldController@company');
Route::get('branch','CustomFieldController@branch');


Route::get('custom_field','CustomFieldController@depends');
Route::get('place','PlaceController@depends');
Route::get('branch','BranchController@depends');

Route::get('locale/{locale}', function ($locale){
    Session::put('locale', $locale);
    return redirect()->back();
});


Route::group(['middleware' => ['CheckActivation', 'auth:customer']], function () {

    Route::get('profile', 'CustomerController@profile')->name('profile');
    Route::get('edit-profile', 'CustomerController@editProfilePage')->name('editPage');
    Route::post('edit-profile', 'CustomerController@editProfile')->name('editProfile');
    Route::get('logout', 'CustomerController@logout')->name('logout');



});

/************************************************************************************
 * Reset Password
 ************************************************************************************/
Route::group(['middleware' => ['web']], function() {
    Route::post('/sendResetEmailWeb', 'Api\ForgotPasswordController@sendResetPasswordEmailWeb');
    Route::get('password/reset', 'Api\ResetPasswordController@showResetForm')->name('resetPassword');
    Route::post('password/reset', 'Api\ResetPasswordController@resetWeb');
});


Route::get('/session/empty','OrderController@emptySession')->name('emptySession');
