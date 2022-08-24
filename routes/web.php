<?php

use App\Libraries\Sologreatsale;
use App\Models\Slider;
use App\Models\Testimoni;
use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@index');

Route::prefix('/auth')->group(function () {
    Route::middleware('sgs.guest')->group(function () {
        Route::get('/login', 'AuthController@login');
        Route::post('/login', 'AuthController@loginAction');
        Route::get('/forgot_password', 'AuthController@forgot_password');
        Route::post('/forgot_password', 'AuthController@forgot_passwordAction');
        Route::get('/register', 'AuthController@register');
        Route::post('/register', 'AuthController@registerAction');
        Route::get('/register_verif_otp/{id}', 'AuthController@registerVerifOtp');
        Route::post('/register_verif_otp/{id}', 'AuthController@registerVerifOtpAction');
        Route::get('/register_verif_otp/{id}/send_otp', 'AuthController@registerVerifOtpSend');
    });

    Route::get('/logout', 'AuthController@logout')->middleware('sgs.user');
});

Route::middleware('sgs.user')->group(function () {
    Route::prefix('/account')->group(function () {
        Route::get('/settings', 'AccountController@settings');
        Route::post('/change_password', 'AccountController@change_password');
    });

    // Master
    Route::namespace('Master')->group(function () {
        // Config
        Route::get('/master-config', 'ConfigController@index');
        Route::get('/master-config/create', 'ConfigController@create');
        Route::post('/master-config/create', 'ConfigController@createAction');
        Route::get('/master-config/update/{id}', 'ConfigController@update');
        Route::post('/master-config/update/{id}', 'ConfigController@updateAction');
        Route::get('/master-config/delete/{id}', 'ConfigController@delete');
        Route::post('/master-config/delete/{id}', 'ConfigController@deleteAction');

        // Konten
        Route::get('/master-konten', 'KontenController@index');
        Route::get('/master-konten/create', 'KontenController@create');
        Route::post('/master-konten/create', 'KontenController@createAction');
        Route::get('/master-konten/update/{id}', 'KontenController@update');
        Route::post('/master-konten/update/{id}', 'KontenController@updateAction');
        Route::get('/master-konten/delete/{id}', 'KontenController@delete');
        Route::post('/master-konten/delete/{id}', 'KontenController@deleteAction');

        // Undian
        Route::get('/master-undian', 'UndianController@index');
        Route::get('/master-undian/create', 'UndianController@create');
        Route::post('/master-undian/create', 'UndianController@createAction');
        Route::get('/master-undian/update/{id}', 'UndianController@update');
        Route::post('/master-undian/update/{id}', 'UndianController@updateAction');
        Route::get('/master-undian/delete/{id}', 'UndianController@delete');
        Route::post('/master-undian/delete/{id}', 'UndianController@deleteAction');

        // Tenant
        Route::get('/master-tenant', 'TenantController@index');
        Route::get('/master-tenant/create', 'TenantController@create');
        Route::post('/master-tenant/create', 'TenantController@createAction');
        Route::get('/master-tenant/update/{id}', 'TenantController@update');
        Route::post('/master-tenant/update/{id}', 'TenantController@updateAction');
        Route::get('/master-tenant/delete/{id}', 'TenantController@delete');
        Route::post('/master-tenant/delete/{id}', 'TenantController@deleteAction');

        // Kategori Tenant
        Route::get('/master-kategori-tenant', 'KategoriTenantController@index');
        Route::get('/master-kategori-tenant/create', 'KategoriTenantController@create');
        Route::post('/master-kategori-tenant/create', 'KategoriTenantController@createAction');
        Route::get('/master-kategori-tenant/update/{id}', 'KategoriTenantController@update');
        Route::post('/master-kategori-tenant/update/{id}', 'KategoriTenantController@updateAction');
        Route::get('/master-kategori-tenant/delete/{id}', 'KategoriTenantController@delete');
        Route::post('/master-kategori-tenant/delete/{id}', 'KategoriTenantController@deleteAction');

        // Produk Tenant
        Route::get('/master-produk-tenant', 'ProdukTenantController@index');
        Route::get('/master-produk-tenant/create', 'ProdukTenantController@create');
        Route::post('/master-produk-tenant/create', 'ProdukTenantController@createAction');
        Route::get('/master-produk-tenant/update/{id}', 'ProdukTenantController@update');
        Route::post('/master-produk-tenant/update/{id}', 'ProdukTenantController@updateAction');
        Route::get('/master-produk-tenant/delete/{id}', 'ProdukTenantController@delete');
        Route::post('/master-produk-tenant/delete/{id}', 'ProdukTenantController@deleteAction');

        // Slider
        Route::get('/master-slider', 'SliderController@index');
        Route::get('/master-slider/create', 'SliderController@create');
        Route::post('/master-slider/create', 'SliderController@createAction');
        Route::get('/master-slider/update/{id}', 'SliderController@update');
        Route::post('/master-slider/update/{id}', 'SliderController@updateAction');
        Route::get('/master-slider/delete/{id}', 'SliderController@delete');
        Route::post('/master-slider/delete/{id}', 'SliderController@deleteAction');

        // Testimoni
        Route::get('/master-testimoni', 'TestimoniController@index');
        Route::get('/master-testimoni/create', 'TestimoniController@create');
        Route::post('/master-testimoni/create', 'TestimoniController@createAction');
        Route::get('/master-testimoni/update/{id}', 'TestimoniController@update');
        Route::post('/master-testimoni/update/{id}', 'TestimoniController@updateAction');
        Route::get('/master-testimoni/delete/{id}', 'TestimoniController@delete');
        Route::post('/master-testimoni/delete/{id}', 'TestimoniController@deleteAction');
    });
});

// Tenant
Route::prefix('/fo')->group(function () {
    Route::namespace('Tenant')->group(function () {
        Route::get('/', 'HomeController@index');

        // Kategori
        Route::get('/kategori', 'KategoriController@index');
        Route::get('/kategori/{id}/induk', 'KategoriController@induk');
        Route::get('/kategori/{id}', 'KategoriController@showProduk');

        // Cart
        Route::get('/carts', 'CartsController@index');
        Route::post('/carts/checkout', 'CartsController@checkout');
        Route::middleware(['sgs.user'])->group(function () {
            Route::get('/carts/checkout/confirm', 'CartsController@checkoutConfirm');
            Route::post('/carts/checkout/confirm', 'CartsController@checkoutConfirmAction');
            Route::get('/transaksis', 'TransaksiController@index');
        });

        // Pages
        Route::get('/pages/contact', 'PagesController@contact');
        Route::get('/pages/{code}', 'PagesController@index');

        // Ajax
        Route::prefix('/ajax')->group(function () {
            Route::get('/produk_detail', 'AjaxController@produkDetail');
        });
    });
});
