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
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\RecordingController;
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
    Route::resource('languages', LanguageController::class)->except(['create']);
    Route::resource('modules', ModuleController::class)->except(['create']);
    Route::resource('phrases', PhraseController::class);
    Route::resource('recordings', RecordingController::class);

    Route::resource('questions', QuestionController::class);

    Route::get('questions/quiz/{language_id}', [QuestionController::class, 'startQuiz'])->name('questions.start');

    Route::get('home/languages/manage/{language}/region/{variant}', [HomeController::class, 'manageLanguage'])->name('languages.manage');
    Route::get('home/languages/add', [HomeController::class, 'addLanguage'])->name('languages.add');
    Route::get('/home/{user}/enrol-language', [UserController::class, 'showEnrolLanguage'])->name("users.enrolLanguage");
    Route::get('/test', [TestController::class, 'index'])->name('test');
    Route::get('/admin-portal', [PortalController::class, 'index'])->name('portal');
    Route::get('/modules/create/{language_id}', [ModuleController::class, 'create'])->name('modules.create');
    Route::get('/modules/manage-module-phrases/{module_id}', [ModuleController::class, 'managePhrases'])->name('modules.managePhrases');

    Route::patch('home/languages/updateVoice/{variant}', [HomeController::class, 'updateVoice'])->name('languages.updateVoice');
    Route::post('/recordings/generate/{phrase}', [RecordingController::class, 'generate'])->name('recordings.generate');
    Route::post('/modules/{module}/update-phrases', [ModuleController::class, 'updatePhrases'])->name('modules.updatePhrases');
});