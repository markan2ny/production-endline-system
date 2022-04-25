<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\AddStudentComponent;

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
Route::get('/getModel/{id}', [\App\Http\Controllers\GproController::class, 'getModel']);

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


// restore archive
Route::patch('/style/{id}/restore', [\App\Http\Controllers\AdminController::class, 'restoreStyle'])->name('style_restore');
// delete archive
Route::delete('/style/{id}/delete', [\App\Http\Controllers\AdminController::class, 'deleteStyle'])->name('style_delete');

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'isAdmin'], 'as' => 'admin.'], function(){
    Route::get('/', [\App\Http\Controllers\AdminController::class, 'home'])->name('home');
    Route::get('/style', [\App\Http\Controllers\AdminController::class, 'showStyle'])->name('styles');
    Route::view('/style/create', 'dashboard.admin.create_new_style')->name('create.style');
    Route::post('/style/create', [App\Http\Controllers\AdminController::class, 'storeStyle'])->name('store.style');
    Route::get('style/{id}', [\App\Http\Controllers\AdminController::class, 'showModel'])->name('show.model');
    Route::delete('style/{id}', [\App\Http\Controllers\AdminController::class, 'deleteStyle'])->name('delete.style');
    Route::delete('/model/{id}', [\App\Http\Controllers\AdminController::class, 'deleteModel'])->name('delete.model');
    Route::get('/model/{id}/edit', [\App\Http\Controllers\AdminController::class, 'editModel'])->name('edit.model');
    Route::patch('/model/{id}', [\App\Http\Controllers\AdminController::class, 'updateModel'])->name('update.model');
    Route::get('style/{id}/create', [\App\Http\Controllers\AdminController::class, 'createModel'])->name('create.model');
    Route::post('/style/{id}/create', [\App\Http\Controllers\AdminController::class, 'storeModel'])->name('store_model');
    Route::get('/user/create', [\App\Http\Controllers\AdminController::class, 'CreateUserAndattachGroup'])->name('create.user');
    Route::get('/user', [\App\Http\Controllers\AdminController::class, 'showUser'])->name('user');
    Route::post('/user/create', [\App\Http\Controllers\AdminController::class, 'storeUser'])->name('store.user');
    Route::delete('/user/{id}', [\App\Http\Controllers\AdminController::class, 'deleteUser'])->name('delete.user');
    Route::get('/group', [\App\Http\Controllers\AdminController::class, 'showGroup'])->name('group');
    Route::get('/group/create', [\App\Http\Controllers\AdminController::class, 'createGroup'])->name('create.group');
    Route::post('/group/create', [\App\Http\Controllers\AdminController::class, 'storeGroup'])->name('store.group');
    Route::delete('/group/{id}', [\App\Http\Controllers\AdminController::class, 'deleteGroup'])->name('delete.group');



    // Report
    Route::get('/report', [\App\Http\Controllers\AdminController::class, 'viewReport'])->name('report');
    //Search Report
    Route::post('/report', [\App\Http\Controllers\AdminController::class, 'viewReport'])->name('searchRprt');
    // softdelete
    Route::delete('/{style}/style', [\App\Http\Controllers\AdminController::class, 'styleSoftdelete'])->name('style_delete');
    // archive
    // Route::get('/style/archive', [\App\Http\Controllers\AdminController::class, 'viewArchive'])->name('archive');

    //Quota
    Route::get('/quota', [\App\Http\Controllers\AdminController::class, 'viewQuota'])->name('quota');

    Route::get('/chart', [\App\Http\Controllers\AdminController::class, 'chart']);


});

Route::group(['prefix' => 'gpro', 'middleware' => ['auth','access'], 'as' => 'gpro.'], function() {
    Route::get('/', [\App\Http\Controllers\GproController::class, 'home'])->name('home');
    Route::post('/', [\App\Http\Controllers\GproController::class, 'store'])->name('record_store');
    Route::get('/{id}',[\App\Http\Controllers\GproController::class, 'completedRprt'])->name('completedRprt');

});