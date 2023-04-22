<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PartProcessStructureController as PartProcess;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Tools\MasterToolController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::redirect('/', '/gna-cat');
Route::get('gna-cat', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth')->name('home');

Route::prefix('gna-cat')->group(function () {
    /* ------------------------------- Login Route ------------------------------ */
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login/action', [LoginController::class, 'authenticate'])->name('login.auth');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::post('/change-pass',  [LoginController::class, 'changePass'])->name('change.pass');
    Route::post('/user-search', [App\Http\Controllers\Admin\UserController::class, 'userSearch'])->name('user.search');

    Route::middleware('auth')->group(function(){
        /* ----------------------------- Catalogue Route ---------------------------- */
        Route::name('tools.')->group(function() {
            Route::prefix('tools')->group(function() {
                Route::resource('/master', MasterToolController::class);
                Route::get('/get-master-tool', [MasterToolController::class, 'getMasterTool'])->name('get.data');
                Route::post('/dwg-upload', [MasterToolController::class, 'toolDwgUpload'])->name('dwg.upload');
            });
        });
        /* ------------------------------- Admin Route ------------------------------ */
        Route::middleware('isAdmin')->group(function(){
            Route::name('admin.')->group(function() {
                Route::get('/department-section', App\Http\Controllers\Admin\SectionDepartmentController::class)->name('department');
                Route::resource('/department', App\Http\Controllers\Admin\DepartmentController::class)->only('index', 'store', 'destroy');
                Route::resource('/section', App\Http\Controllers\Admin\SectionController::class)->only('index', 'store', 'destroy');
                Route::resource('/model', App\Http\Controllers\Admin\ModelPartController::class)->except(['create', 'edit']);
                Route::post('search-model', [App\Http\Controllers\Admin\ModelPartController::class, 'searchModel'])->name('search.model');
                Route::resource('/part', App\Http\Controllers\Admin\PartController::class)->only('index', 'show', 'store', 'destroy');
                Route::post('/search-part', [App\Http\Controllers\Admin\PartController::class, 'searchPart'])->name('search.part');
                Route::resource('/process', App\Http\Controllers\Admin\MasterProcessController::class)->only('index', 'show', 'store', 'destroy');
                Route::post('/search-process',[App\Http\Controllers\Admin\MasterProcessController::class , 'searchProcess'])->name('search.process');
                Route::resource('/part-process', PartProcess::class)->only('index', 'store');
                Route::resource('/user', App\Http\Controllers\Admin\UserController::class);
            });
        });
        
    });
    
    
    
});