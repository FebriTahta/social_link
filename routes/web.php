<?php
use App\Http\Controllers\LinkController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\BGController;
use App\Models\Link;
use App\Http\Middleware\CheckRole;
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
    // return view('welcome');
    // return view('be.be_tautan');
    // return redirect('/{slug_aplikasi}');
    return redirect('/login');
});

// BASIC ROUTE
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth', 'CheckRole:admin,superadmin']], function () {
// BE
Route::get('/be-link-page',[LinkController::class,'be_link_page'])->name('be_link.page');
Route::post('/be-link-store',[LinkController::class,'be_link_store'])->name('be_link.store');
Route::get('/be-link-data',[LinkController::class,'be_link_data'])->name('be_link.data');
Route::post('/be-link-dell',[LinkController::class,'be_link_dell'])->name('be_link.dell');

Route::get('/be-subsosmed-data',[LinkController::class,'be_subsosmed_data'])->name('be_subsosmed.data');
Route::post('/be-subsosmed-dell',[LinkController::class,'be_subsosmed_dell'])->name('be_subsosmed.dell');
Route::post('/be-subsosmed-store',[LinkController::class, 'be_subsosmed_store'])->name('be_subsosmed.store');

Route::get('/be-user-page',[UserController::class,'be_user_page'])->name('be_user.page');
Route::post('/be-user-store',[UserController::class,'be_user_store'])->name('be_user.store');
Route::get('/be-user-data',[UserController::class,'be_user_data'])->name('be_user.data');
Route::post('/be-user-dell',[UserController::class,'be_user_dell'])->name('be_user.dell');

Route::post('/be-aplikasi-store',[LinkController::class,'be_aplikasi_store'])->name('be_aplikasi.store');
Route::get('/be-aplikasi-data',[LinkController::class,'be_aplikasi_data'])->name('be_aplikasi.data');
Route::get('/be-get-link',[LinkController::class, 'be_get_link'])->name('be_get.link');

Route::get('/be-bg-page',[BGController::class, 'be_bg_page'])->name('be_bg.page');
Route::post('/be-bg-store',[BGController::class, 'be_bg_store'])->name('be_bg.store');
Route::post('/be-bg-dell',[BGController::class,'be_bg_delete'])->name('be_bg.dell');
Route::get('/be-bg-get',[BGController::class,'be_bg_get'])->name('be_bg.get');
Route::post('/be-bg-add',[BGController::class,'be_add_bg'])->name('be_bg.add');
Route::get('/be-bg-app-data',[BGController::class, 'be_bg_app_data'])->name('bg_app.data');
});


// FE
Route::get('/{slug_aplikasi}',[FrontEndController::class,'fe_landing_page'])->name('landing');