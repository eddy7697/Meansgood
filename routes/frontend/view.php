<?php


/**
 * INDEX
 */
Route::get('/', 'Frontend\PageController@index');

/**
 * about
 */
 Route::group(['prefix' => 'about'], function()
 {
     Route::get('/', 'Frontend\PageController@about')->name('about');
     Route::get('/professional', 'Frontend\PageController@professional')->name('professional');
     Route::get('/certificate', 'Frontend\PageController@certificate')->name('certificate');
     Route::get('/cordyceps', 'Frontend\PageController@cordyceps')->name('cordyceps');
     Route::get('/isaria', 'Frontend\PageController@isaria')->name('isaria');
     Route::get('/privacy', 'Frontend\PageController@privacy')->name('privacy');
     Route::get('/notice', 'Frontend\PageController@notice')->name('notice');
     Route::get('/store', 'Frontend\PageController@store')->name('store');
 });

/**
 * PRODUCT
 */
// Route::get('/product-deatil/{guid}', 'Frontend\ProductController@productDetail');
// Route::get('/product-deatil/{id}/show', 'Frontend\ProductController@productDetailFromId');
Route::get('/product-deatil/{path}', 'Frontend\ProductController@productDetailFromPath');
Route::get('/product-all', 'Frontend\PageController@productAll');
Route::get('/product-category/{guid}', 'Frontend\ProductController@productCategory');

/**
 * Post
 */
Route::get('/blog', function ()
{
    return view('frontend.blog.list', [
        'isThumbShow' => false,
    ]);
})->name('blog');
// Route::get('/blog/{guid}', function ($guid)
// {
//     return view('frontend.blog.post', [
//         'post' => PostView::get($guid),
//         'isThumbShow' => false,
//     ]);
// });
Route::get('/blog/{id}/detail', function ($id)
{
    return view('frontend.blog.post', [
        'post' => PostView::getById($id),
        'isThumbShow' => false,
    ]);
});
Route::get('/blog/{path}', function ($path)
{
    return view('frontend.blog.post', [
        'post' => PostView::getByPath($path),
        'isThumbShow' => false,
    ]);
});

/**
 * MEMBER
 */
Route::get('/login', 'Frontend\PageController@login');
Route::get('/register', 'Frontend\PageController@register');
Route::get('/forget-password', function ()
{
    return view('frontend.authentication.forgetPassword', [
        'isThumbShow' => false,
    ]);
});
Route::get('/reset-password/{token}', 'Frontend\UserController@resetPasswordPage');

/**
 * DASHBOARD
 */
Route::group(['prefix' => 'user', 'middleware' => 'checkUser'], function()
{
    Route::get('/', 'Frontend\DashboardController@index');
    Route::get('/address', 'Frontend\DashboardController@address');
    Route::get('/information', 'Frontend\DashboardController@information');
    Route::post('/modifyInformation', 'Frontend\DashboardController@modifyInformation');
});

/**
 * BUSINESS LOGIC
 */
Route::group(['middleware' => 'auth'], function ()
{
    Route::get('/checkout', 'Frontend\BuisnessController@checkout');
    Route::get('/order', 'Frontend\BuisnessController@order');
    /**
     * trans to checkout
     */

    Route::get('/checkout/getPoint', 'Frontend\BuisnessController@getPoint');
});
Route::post('/checkout/billing', 'Frontend\BuisnessController@transToCheckout');
Route::get('/cart', 'Frontend\BuisnessController@cart');
Route::post('/orderChecking', 'Frontend\BuisnessController@orderChecking')->name('orderChecking');
Route::get('/check-order', function ()
{
    return view('frontend.checkoutMethod.checkOrder', [
        'isThumbShow' => false,
        'thumb' => null
    ]);
});

/**
 * Search
 */
Route::get('/search', function () {
    return view('search', [
        'product' => [],
        'post' => [],
        'isThumbShow' => false,
        'thumb' => null
    ]);
 });
Route::post('/search-option', 'Frontend\SearchController@searchProduct');
Route::get('/importScout', 'Frontend\SearchController@importScout');


/**
 * test area
 */
Route::get('/ga-test', 'HomeController@gaTest');
// Route::get('/test-area', function ()
// {
//     return view('test', [
//         'title' => 'test',
//         'shortcut' => '',
//         'product' => [],
//         'post' => [],
//         'isThumbShow' => false,
//         'thumb' => null
//     ]);
// });
// Route::post('/test-post', 'HomeController@testPost');
// Route::get('/test-action', 'HomeController@testAction');
// Route::get('/truncate', 'HomeController@truncate');
