<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\HomeController;

use App\Http\Controllers\MainController;
use App\Http\Controllers\MainCategoryController;
use App\Http\Controllers\MainBookController;

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
    Route::prefix('admin')->group(function () {
        /* Author Controller Routes */
        Route::controller(AuthorController::class)->group(function() {
            Route::get('author', 'index')->name('author.all');
            Route::get('author/create', 'create')->name('author.create');
            Route::post('author/store', 'store')->name('author.store');
            Route::get('author/{id}/edit', 'edit')->name('author.edit');
            Route::put('author/{id}', 'update')->name('author.update');
            Route::get('author/delete/{id}', 'destroy')->name('author.destroy');
            Route::get('author/{id}/status', 'status')->name('author.status');
            Route::get('author/active_all_status', 'active_all_status')->name('author.active_all_status');
            Route::get('author/deactive_all_status', 'deactive_all_status')->name('author.deactive_all_status');
            Route::get('author/delete_all', 'delete_all')->name('author.delete_all');
        });

        /* Category Controller Routes */
        Route::controller(CategoryController::class)->group(function() {
            Route::get('category', 'index')->name('category.all');
            Route::get('category/create', 'create')->name('category.create');
            Route::post('category/store', 'store')->name('category.store');
            Route::get('category/{id}/edit', 'edit')->name('category.edit');
            Route::put('category/{id}', 'update')->name('category.update');
            Route::get('category/delete/{id}', 'destroy')->name('category.destroy');
            Route::get('category/{id}/status', 'status')->name('category.status');
            Route::get('category/active_all_status', 'active_all_status')->name('category.active_all_status');
            Route::get('category/deactive_all_status', 'deactive_all_status')->name('category.deactive_all_status');
            Route::get('category/delete_all', 'delete_all')->name('category.delete_all');
        });
        
        /* Book Controller Routes */
        Route::controller(BookController::class)->group(function() {
            Route::get('book', 'index')->name('book.all');
            Route::get('book/create', 'create')->name('book.create');
            Route::post('book/store', 'store')->name('book.store');
            Route::get('book/{id}/edit', 'edit')->name('book.edit');
            Route::put('book/{id}', 'update')->name('book.update');
            Route::get('book/delete/{id}', 'destroy')->name('book.destroy');
            Route::get('book/{id}/status', 'status')->name('book.status');
            Route::get('book/active_all_status', 'active_all_status')->name('book.active_all_status');
            Route::get('book/deactive_all_status', 'deactive_all_status')->name('book.deactive_all_status');
            Route::get('book/delete_all', 'delete_all')->name('book.delete_all');
        });
        
        /* Media Controller Routes */
        Route::controller(MediaController::class)->group(function() {
            Route::get('media', 'index')->name('media.all');
            Route::get('media/create', 'create')->name('media.create');
            Route::post('media/store', 'store')->name('media.store');
            Route::get('media/{id}/edit', 'edit')->name('media.edit');
            Route::put('media/{id}', 'update')->name('media.update');
            Route::get('media/delete/{id}', 'destroy')->name('media.destroy');
            Route::get('media/{id}/status', 'status')->name('media.status');
            Route::get('media/active_all_status', 'active_all_status')->name('media.active_all_status');
            Route::get('media/deactive_all_status', 'deactive_all_status')->name('media.deactive_all_status');
            Route::get('media/delete_all', 'delete_all')->name('media.delete_all');
        });

        /* Team Controller Routes */
        Route::controller(TeamController::class)->group(function() {
            Route::get('team', 'index')->name('team.all');
            Route::get('team/create', 'create')->name('team.create');
            Route::post('team/store', 'store')->name('team.store');
            Route::get('team/{id}/edit', 'edit')->name('team.edit');
            Route::put('team/{id}', 'update')->name('team.update');
            Route::get('team/delete/{id}', 'destroy')->name('team.destroy');
            Route::get('team/{id}/status', 'status')->name('team.status');
            Route::get('team/active_all_status', 'active_all_status')->name('team.active_all_status');
            Route::get('team/deactive_all_status', 'deactive_all_status')->name('team.deactive_all_status');
            Route::get('team/delete_all', 'delete_all')->name('team.delete_all');
        });
        
    });
    

Route::middleware('auth')->group(function () {
    Route::get('/admin/profile', [HomeController::class, 'profile'])->name('profile');
    Route::post('/admin/profile/update', [HomeController::class, 'profile_update'])->name('profile.update');
    Route::post('/admin/profile/change_password', [HomeController::class, 'change_password'])->name('change.password');
    
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

/**** FRONTENED DEVELOPMENT ****/
    Route::get('/about', [MainController::class, 'about'])->name('about');
    Route::get('/gallery', [MainController::class, 'gallery'])->name('gallery');
    Route::get('/author', [MainController::class, 'author'])->name('author');
    Route::get('/author_detail/{slug}', [MainController::class, 'author_detail'])->name('author.detail');
    Route::get('/contact', [MainController::class, 'contact'])->name('contact');
    Route::get('/', [MainController::class, 'index'])->name('home');

    Route::get('/category/{slug}', [MainCategoryController::class, 'show'])->name('category.show');
    Route::get('/book/{slug}', [MainBookController::class, 'show'])->name('book.show');

    Route::post('/send-mail', [MainController::class, 'contact_index'])->name('send-mail');
