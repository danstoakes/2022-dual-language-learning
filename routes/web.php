<?php

use App\Http\Controllers\AJAXController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PhraseController;
use App\Http\Controllers\PortalController;
use App\Http\Controllers\TestController;
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

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('languages', LanguageController::class);
    Route::resource('modules', ModuleController::class)->except(['create']);
    Route::resource('phrases', PhraseController::class);
    Route::get('/test', [TestController::class, 'index'])->name('test');
    Route::get('/admin-portal', [PortalController::class, 'index'])->name('portal');
    Route::get('/modules/create/{language_id}', [ModuleController::class, 'create'])->name('modules.create');
    Route::get('/phrases/add-to-module/{module_id}', [PhraseController::class, 'addtoModule'])->name('modules.addPhrase');
    Route::post('/ajax-request/send', [AJAXController::class, 'POST'])->name('ajax.post');
});