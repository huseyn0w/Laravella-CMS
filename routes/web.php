<?php

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

Auth::routes();

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('cpanel-logout');



//Cpanel Routes
Route::prefix('cpanel')->middleware(['auth'])->namespace('Cpanel')->group(function () {

    Route::get('/', 'CPanelHomeController@index')->name('cpanel_home');

    Route::prefix('general-settings')->group(function(){
        Route::get('/', 'CPanelGeneralSettingController@index')->name('cpanel_general_settings');
        Route::post('/', 'CPanelGeneralSettingController@store')->name('cpanel_update_general_settings');
    });

    Route::get('/myprofile', 'CPanelMyProfileController@index')->name('cpanel_myprofile');

    Route::get('/menus', 'CPanelMenuController@index')->name('cpanel_menus');

    Route::get('/roles', 'CPanelRoleController@index')->name('cpanel_roles');
});


Route::get('/', 'HomeController@index')->name('home');




