<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/test', [\App\Http\Controllers\AdminController::class, 'viewArchive']);

// restore archive
Route::patch('/style/{id}/restore', [\App\Http\Controllers\AdminController::class, 'restoreStyle'])->name('style_restore');
// delete archive
Route::delete('/style/{id}/delete', [\App\Http\Controllers\AdminController::class, 'deleteStyle'])->name('style_delete');

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'isAdmin'], 'as' => 'admin.'], function(){
    Route::view('/', 'dashboard.admin.index')->name('home');
    // Route::view('/style', 'dashboard.admin.styles')->name('styles');
    Route::get('/style', [\App\Http\Controllers\AdminController::class, 'showStyle'])->name('styles');
    Route::view('/style/create', 'dashboard.admin.create_new_style')->name('create.style');
    Route::post('/style/create', [App\Http\Controllers\AdminController::class, 'storeStyle'])->name('store.style');
    // Route::view('/user/create', 'dashboard.admin.register')->name('create.user');
    Route::get('/user/create', [\App\Http\Controllers\AdminController::class, 'CreateUserAndattachGroup'])->name('create.user');
    Route::get('/user', [\App\Http\Controllers\AdminController::class, 'showUser'])->name('user');
    Route::post('/user/create', [\App\Http\Controllers\AdminController::class, 'storeUser'])->name('store.user');
    Route::get('/group', [\App\Http\Controllers\AdminController::class, 'showGroup'])->name('group');
    Route::get('/group/create', [\App\Http\Controllers\AdminController::class, 'createGroup'])->name('create.group');
    Route::post('/group/create', [\App\Http\Controllers\AdminController::class, 'storeGroup'])->name('store.group');

    // softdelete
    Route::delete('/{style}/style', [\App\Http\Controllers\AdminController::class, 'styleSoftdelete'])->name('style_delete');
    // archive
    Route::get('/style/archive', [\App\Http\Controllers\AdminController::class, 'viewArchive'])->name('style_archive');

});

Route::group(['prefix' => 'gpro', 'middleware' => ['auth','access'], 'as' => 'gpro.'], function() {
    Route::get('/', [\App\Http\Controllers\GproController::class, 'home'])->name('home');
    // Pass the style id to the next record page.
    Route::get('/{id}/record', [\App\Http\Controllers\GproController::class, 'record'])->name('record');
    Route::post('/{id}/record', [\App\Http\Controllers\GproController::class, 'storeRecord'])->name('store_record');
    Route::get('/queue', [\App\Http\Controllers\GproController::class, 'queue'])->name('record_queue');
});