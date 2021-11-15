<?php
use App\Http\Controllers\LinkController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FrontEndController;
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
    return redirect('/{slug_aplikasi}');
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

Route::get('be-user-page',[UserController::class,'be_user_page'])->name('be_user.page');
Route::post('be-user-store',[UserController::class,'be_user_store'])->name('be_user.store');
Route::get('be-user-data',[UserController::class,'be_user_data'])->name('be_user.data');
Route::post('be-user-dell',[UserController::class,'be_user_dell'])->name('be_user.dell');

Route::post('be-aplikasi-store',[LinkController::class,'be_aplikasi_store'])->name('be_aplikasi.store');
Route::get('be-aplikasi-data',[LinkController::class,'be_aplikasi_data'])->name('be_aplikasi.data');
});


// FE
Route::get('/{slug_aplikasi}',[FrontEndController::class,'fe_landing_page'])->name('landing');