<?php

use Illuminate\Support\Facades\Route;
use App\Role;

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

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/blank', function () {
    return view('blank');
})->name('blank');

Route::middleware('auth')->group(function() {
    Route::get('user/create_kasir', 'UserController@create_kasir')->name('user.create_kasir')->middleware(['role:' . Role::ROLE_ADMIN]); 
    Route::post('user/store_kasir', 'UserController@store_kasir')->name('user.store_kasir')->middleware(['role:' . Role::ROLE_ADMIN]); 
    Route::get('user/create_owner', 'UserController@create_owner')->name('user.create_owner')->middleware(['role:' . Role::ROLE_ADMIN]); 
    Route::post('user/store_owner', 'UserController@store_owner')->name('user.store_owner')->middleware(['role:' . Role::ROLE_ADMIN]);  
    Route::resource('user', UserController::class)->middleware(['role:' . Role::ROLE_ADMIN]); 
    
});

Route::middleware('auth')->group(function() {
    Route::resource('member', MemberController::class)->middleware(['role:' . implode('|', [Role::ROLE_ADMIN, Role::ROLE_KASIR])]);    
});

Route::middleware('auth')->group(function() {
    Route::resource('paket', PaketController::class)->middleware(['role:' . Role::ROLE_ADMIN]);    
});

Route::middleware('auth')->group(function() {
    Route::get('transaksi/export', 'TransaksiController@export')->name('transaksi.export');
    Route::get('transaksi/print/{id_transaksi}', 'TransaksiController@print')->name('transaksi.print');
    Route::get('transaksi/index_detail/{id_transaksi}', 'TransaksiController@index_detail')->name('transaksi.index_detail')->middleware(['role:' . implode('|', [Role::ROLE_ADMIN, Role::ROLE_KASIR])]);
    Route::get('transaksi/index_owner', 'TransaksiController@index_owner')->name('transaksi.index_owner')->middleware(['role:' . Role::ROLE_OWNER]);
    Route::get('transaksi/detail_owner', 'TransaksiController@detail_owner')->name('transaksi.detail_owner')->middleware(['role:' . Role::ROLE_OWNER]);
    Route::get('transaksi/index_detailowner/{id_transaksi}', 'TransaksiController@index_detailowner')->name('transaksi.index_detailowner')->middleware(['role:' . Role::ROLE_OWNER]);
    Route::get('transaksi/create_detail', 'TransaksiController@create_detail')->name('transaksi.create_detail')->middleware(['role:' . implode('|', [Role::ROLE_ADMIN, Role::ROLE_KASIR])]);
    Route::get('transaksi/edit_detail/{id}', 'TransaksiController@edit_detail')->name('transaksi.edit_detail')->middleware(['role:' . implode('|', [Role::ROLE_ADMIN, Role::ROLE_KASIR])]);
    Route::get('transaksi/edit_proses/{id}', 'TransaksiController@edit_proses')->name('transaksi.edit_proses')->middleware(['role:' . implode('|', [Role::ROLE_ADMIN, Role::ROLE_KASIR])]);
    Route::post('transaksi/store_detail', 'TransaksiController@store_detail')->name('transaksi.store_detail')->middleware(['role:' . implode('|', [Role::ROLE_ADMIN, Role::ROLE_KASIR])]);
    Route::post('transaksi/update_detail', 'TransaksiController@update_detail')->name('transaksi.update_detail')->middleware(['role:' . implode('|', [Role::ROLE_ADMIN, Role::ROLE_KASIR])]);
    Route::put('transaksi/update_proses/{id}', 'TransaksiController@update_proses')->name('transaksi.update_proses')->middleware(['role:' . implode('|', [Role::ROLE_ADMIN, Role::ROLE_KASIR])]);
    Route::delete('transaksi/destroy_detail/{id}', 'TransaksiController@destroy_detail')->name('transaksi.destroy_detail')->middleware(['role:' . implode('|', [Role::ROLE_ADMIN, Role::ROLE_KASIR])]);
    Route::resource('transaksi', TransaksiController::class);    
});

