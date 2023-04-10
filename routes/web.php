<?php

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


Route::middleware('admin')->group(function() {
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/dashboard/car', \App\Http\Controllers\Admin\AdminCarController::class)->except('show');

    Route::post('/dashboard/car/{id}/prices', [\App\Http\Controllers\Admin\CarPriceController::class, 'store'])
        ->name('car.price.save');
    Route::patch('/dashboard/car/price/{id}', [\App\Http\Controllers\Admin\CarPriceController::class, 'update'])
        ->name('car.price.update');
    Route::delete('/dashboard/car/price/{id}/delete', [\App\Http\Controllers\Admin\CarPriceController::class, 'destroy'])
        ->name('car.price.delete');

    Route::post('/dashboard/image-main-save/{id}', [\App\Http\Controllers\Admin\ImageController::class, 'saveMainImage'])->name('image.main');
    Route::post('/dashboard/image-save/{id}', [\App\Http\Controllers\Admin\ImageController::class, 'saveImages'])->name('image.store');
    Route::delete('/dashboard/image-delete/{carId}/{groupId}', [\App\Http\Controllers\Admin\ImageController::class, 'destroy'])->name('image.destroy');


    Route::resource('/dashboard/place', \App\Http\Controllers\Admin\PlaceController::class)->except('show');

    Route::post('/dashboard/image-place/{id}', [\App\Http\Controllers\Admin\ImageController::class, 'savePlaceImage'])->name('image.place');
    Route::post('/dashboard/image-post/{id}', [\App\Http\Controllers\Admin\ImageController::class, 'savePostImage'])->name('image.post');


    Route::resource('/dashboard/meta', \App\Http\Controllers\Admin\MetaController::class)->except('show', 'create');
    Route::get('/dashboard/meta/{type}', [\App\Http\Controllers\Admin\MetaController::class, 'type'])->name('meta.type');


    Route::get('/dashboard/service', [\App\Http\Controllers\Admin\ServiceController::class, 'index'])->name('service.index');
    Route::post('/dashboard/service/store', [\App\Http\Controllers\Admin\ServiceController::class, 'store'])->name('service.store');
    Route::delete('/dashboard/service/{id}/delete', [\App\Http\Controllers\Admin\ServiceController::class, 'destroy'])->name('service.destroy');

    Route::get('/dashboard/setting/', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('setting.index');
    Route::patch('/dashboard/setting/update', [\App\Http\Controllers\Admin\SettingController::class, 'updateAll'])->name('setting.update');

    Route::get('/dashboard/order/', [\App\Http\Controllers\Admin\OrderController::class, 'index'])->name('order.index');
    Route::get('/dashboard/order/{id}', [\App\Http\Controllers\Admin\OrderController::class, 'show'])->name('order.show');

    Route::resource('/dashboard/post', \App\Http\Controllers\Admin\PostController::class)->except('show');
    Route::resource('/dashboard/page', \App\Http\Controllers\Admin\PageController::class)->except('show');
});

//Route::post('/get-price', [\App\Http\Controllers\User\CarAjaxController::class, 'place'])->name('order.place');



Route::middleware('collect')->group(function() {
    Route::get('/', [\App\Http\Controllers\User\CarController::class, 'index'])->name('home');
    Route::get('/car', [\App\Http\Controllers\User\CarController::class, 'car'])->name('car');

    Route::get('/dash', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('loginForm')->middleware('login');
    Route::post('/login', [\App\Http\Controllers\Admin\UserController::class, 'login'])->name('login')->middleware('login');
    Route::get('/logout', [\App\Http\Controllers\Admin\UserController::class, 'logout'])->name('logout');

    Route::get('/car/{slug}', [\App\Http\Controllers\User\CarController::class, 'show'])->name('user.car.show');


    Route::post('/car/{id}/order/', [\App\Http\Controllers\User\OrderController::class, 'store'])->name('order.store');

    Route::get('/blog', [\App\Http\Controllers\User\PostController::class, 'index'])->name('user.post.index');
    Route::get('/blog/{slug}', [\App\Http\Controllers\User\PostController::class, 'show'])->name('user.post.show');

    Route::get('/sitemap', [\App\Http\Controllers\SitemapController::class, 'index']);
    Route::get('/sitemap/cars', [\App\Http\Controllers\SitemapController::class, 'cars']);
    Route::get('/sitemap/metas', [\App\Http\Controllers\SitemapController::class, 'metas']);
    Route::get('/sitemap/pages', [\App\Http\Controllers\SitemapController::class, 'pages']);
    Route::get('/sitemap/places', [\App\Http\Controllers\SitemapController::class, 'places']);
    Route::get('/sitemap/posts', [\App\Http\Controllers\SitemapController::class, 'posts']);

    Route::get('/{type}/{slug}', [\App\Http\Controllers\User\MetaController::class, 'meta'])->name('meta.show');



    Route::get('/{slug}',[\App\Http\Controllers\User\PagePlaceController::class, 'show'])->name('page-place');


    });
