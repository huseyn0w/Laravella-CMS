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
Route::prefix('cpanel')->middleware(['auth','permission'])->namespace('Cpanel')->group(function () {

    Route::get('/', 'CPanelHomeController@index')->name('cpanel_home');

    Route::prefix('general-settings')->group(function(){
        Route::get('/', 'CPanelGeneralSettingController@index')->name('cpanel_general_settings');
        Route::post('/', 'CPanelGeneralSettingController@store')->name('cpanel_update_general_settings');
    });



    Route::prefix('myprofile')->group(function(){
        Route::get('/', 'CPanelMyProfileController@index')->name('cpanel_myprofile');
        Route::post('/', 'CPanelMyProfileController@store')->name('cpanel_update_user_profile');
    });

    Route::prefix('users')->group(function(){
        Route::get('/', 'CpanelUsersController@index')->name('cpanel_all_users_list');
        Route::get('/{$id}/edit', 'CpanelUsersController@edit')->name('cpanel_edit_user_profile');
        Route::get('/{$id}/update', 'CpanelUsersController@update')->name('cpanel_update_user_profile');
        Route::delete('/{$id}/delete', 'CpanelUsersController@delete')->name('cpanel_delete_user');
    });



    Route::get('/menus', 'CPanelMenuController@index')->name('cpanel_menus');

    Route::get('/roles', 'CPanelRoleController@index')->name('cpanel_roles');
});


Route::get('/', 'HomeController@index')->name('home');
Route::get('/unathorized', 'Auth\UserPermissionsController@index')->name('unathorized');




