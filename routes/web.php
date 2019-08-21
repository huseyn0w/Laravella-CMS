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

    Route::prefix('general-settings')->middleware('manage_general_settings')->group(function(){
        Route::get('/', 'CPanelGeneralSettingController@index')->name('cpanel_general_settings');
        Route::post('/', 'CPanelGeneralSettingController@store')->name('cpanel_update_general_settings');
    });



    Route::prefix('myprofile')->group(function(){
        Route::get('/', 'CpanelUsersController@edit')->name('cpanel_myprofile');
    });

    Route::prefix('users')->middleware('manage_users')->group(function(){
        Route::get('/', 'CpanelUsersController@index')->name('cpanel_all_users_list');
        Route::get('/{id}', 'CpanelUsersController@edit')->name('cpanel_edit_user_profile')->where('id', '[0-9]+');
        Route::put('/{id}/update', 'CpanelUsersController@update')->name('cpanel_update_user_profile')->where('id', '[0-9]+');
        Route::delete('/{id}/delete', 'CpanelUsersController@deleteAjax')->name('cpanel_delete_user')->where('id', '[0-9]+');
        Route::delete('/multipleDelete', 'CpanelUsersController@multipleDelete')->name('cpanel_users_bulk_delete');
        Route::get('/new', 'CpanelUsersController@addUser')->name('cpanel_add_new_user');
        Route::post('/new', 'CpanelUsersController@saveUser')->name('cpanel_save_new_user');
    });


    Route::get('/menus', 'CPanelMenuController@index')->name('cpanel_menus');

    Route::prefix('roles')->middleware('manage_roles')->group(function(){
        Route::get('/', 'CPanelRoleController@index')->name('cpanel_user_roles');
        Route::get('/{id}', 'CpanelRoleController@edit')->name('cpanel_edit_user_role')->where('id', '[0-9]+');
        Route::put('/{id}/update', 'CpanelRoleController@update')->name('cpanel_update_user_role')->where('id', '[0-9]+');
        Route::delete('/{id}/delete', 'CpanelRoleController@deleteAjax')->name('cpanel_delete_user_role')->where('id', '[0-9]+');
        Route::get('/new', 'CpanelRoleController@addRole')->name('cpanel_add_user_role');
        Route::post('/new', 'CpanelRoleController@saveRole')->name('cpanel_save_user_role');
    });

    Route::prefix('pages')->middleware('manage_pages')->group(function(){
        Route::get('/', 'CPanelPageController@index')->name('cpanel_pages_list');
        Route::get('/{id}', 'CpanelPageController@edit')->name('cpanel_edit_page')->where('id', '[0-9]+');
        Route::put('/{id}/update', 'CpanelPageController@update')->name('cpanel_update_page')->where('id', '[0-9]+');
        Route::delete('/multipleDelete', 'CpanelPageController@multipleDelete')->name('cpanel_pages_bulk_delete');
        Route::delete('/{id}/delete', 'CpanelPageController@deleteAjax')->name('cpanel_ajax_soft_delete_page')->where('id', '[0-9]+');
        Route::delete('/multipleDelete', 'CPanelPageController@multipleDelete')->name('cpanel_pages_bulk_delete');
        Route::get('/new', 'CpanelPageController@addPage')->name('cpanel_add_new_page');
        Route::post('/new', 'CpanelPageController@create')->name('cpanel_save_new_page');
    });



});


Route::get('/', 'HomeController@index')->name('home');
Route::get('/unathorized', 'Auth\UserPermissionsController@index')->name('unathorized');




