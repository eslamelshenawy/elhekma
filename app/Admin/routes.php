<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('admin.home');

$router->resource('/brandGroup', brandsGroupController::class);
$router->resource('/tagsGroup', tagsGroupController::class);
$router->resource('/customFileds', customFieldsController::class);
$router->resource('/targetAudience', targetAudienceController::class);
$router->resource('/colors', colorsController::class);
$router->resource('effectiveMaterial', effectiveMaterialController::class);
$router->resource('pharmaceuticalForm', pharmaceuticalFormController::class);
$router->resource('brands', brandsController::class);
$router->resource('departments', departmentController::class);
$router->resource('branches', outletController::class);
$router->resource('customFiledsItems', customFieldsItemsController::class);
$router->resource('tagItems', tagItemController::class);
$router->resource('storeIdentity', store_identityController::class);
$router->resource('categories', categoriesController::class);
$router->resource('companies', companyControllers::class);
$router->resource('products', productController::class);
$router->resource('productSpecifications', productSpecificationsController::class);
$router->resource('governs', governsController::class);
$router->resource('place', placeController::class);
$router->resource('subCategories', PharmaTagController::class);
$router->resource('orders', OrdersController::class);
$router->resource('settings', SettingController::class);
$router->resource('orders', OrdersController::class);
$router->post('prescriptions/loadProducts', 'PrescriptionController@loadProducts');
$router->post('prescriptions/checkOutlets', 'PrescriptionController@checkOutlets');
$router->post('prescriptions/order', 'PrescriptionController@order');
$router->resource('prescriptions', PrescriptionController::class);
$router->resource('faq', FaqController::class);
$router->resource('reviews', ReviewController::class);
$router->resource('customer', CustomerController::class);
$router->resource('contact_us', ContactUsController::class);
$router->resource('news_letter', NewsLetterController::class);
$router->resource('slider', SliderController::class);
$router->resource('ads', AdsController::class);
$router->resource('mobile_slider', MobileSliderController::class);

// $router->resource('outlets', outletController::class);
$router->resource('companies/{id}/outlets', outletController::class);



});
