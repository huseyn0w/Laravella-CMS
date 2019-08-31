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



//CPanel Routes
Route::prefix('cpanel')->middleware(['auth'])->namespace('cpanel')->group(function () {

    Route::get('/', 'CPanelHomeController@index')->name('cpanel_home');

    Route::prefix('general-settings')->middleware('manage_general_settings')->group(function(){
        Route::get('/', 'CPanelGeneralSettingController@index')->name('cpanel_general_settings');
        Route::post('/', 'CPanelGeneralSettingController@store')->name('cpanel_update_general_settings');
    });



    Route::prefix('myprofile')->group(function(){
        Route::get('/', 'CPanelUsersController@edit')->name('cpanel_myprofile');
    });

    Route::prefix('users')->middleware('manage_users')->group(function(){
        Route::get('/', 'CPanelUsersController@index')->name('cpanel_all_users_list');
        Route::get('/{id}', 'CPanelUsersController@edit')->name('cpanel_edit_user_profile')->where('id', '[0-9]+');
        Route::put('/{id}/update', 'CPanelUsersController@update')->name('cpanel_update_user_profile')->where('id', '[0-9]+');
        Route::delete('/{id}/delete', 'CPanelUsersController@deleteAjax')->name('cpanel_delete_user')->where('id', '[0-9]+');
        Route::delete('/multipleDelete', 'CPanelUsersController@multipleDelete')->name('cpanel_users_bulk_delete');
        Route::get('/new', 'CPanelUsersController@addUser')->name('cpanel_add_new_user');
        Route::post('/new', 'CPanelUsersController@saveUser')->name('cpanel_save_new_user');
    });


    Route::get('/menus', 'CPanelMenuController@index')->name('cpanel_menus');

    Route::prefix('roles')->middleware('manage_roles')->group(function(){
        Route::get('/', 'CPanelRoleController@index')->name('cpanel_user_roles');
        Route::get('/{id}', 'CPanelRoleController@edit')->name('cpanel_edit_user_role')->where('id', '[0-9]+');
        Route::put('/{id}/update', 'CPanelRoleController@update')->name('cpanel_update_user_role')->where('id', '[0-9]+');
        Route::delete('/{id}/delete', 'CPanelRoleController@deleteAjax')->name('cpanel_delete_user_role')->where('id', '[0-9]+');
        Route::get('/new', 'CPanelRoleController@addRole')->name('cpanel_add_user_role');
        Route::post('/new', 'CPanelRoleController@saveRole')->name('cpanel_save_user_role');
    });

    Route::prefix('pages')->middleware('manage_pages')->group(function(){
        Route::get('/', 'CPanelPageController@index')->name('cpanel_pages_list');
        Route::get('/{id}', 'CPanelPageController@edit')->name('cpanel_edit_page')->where('id', '[0-9]+');
        Route::put('/{id}/update', 'CPanelPageController@update')->name('cpanel_update_page')->where('id', '[0-9]+');
        Route::delete('/multipleDelete', 'CPanelPageController@multipleDelete')->name('cpanel_pages_bulk_delete');
        Route::delete('/{id}/delete', 'CPanelPageController@deleteAjax')->name('cpanel_ajax_soft_delete_page')->where('id', '[0-9]+');
        Route::delete('/multipleDelete', 'CPanelPageController@multipleDelete')->name('cpanel_pages_bulk_delete');
        Route::get('/new', 'CPanelPageController@addPage')->name('cpanel_add_new_page');
        Route::post('/new', 'CPanelPageController@create')->name('cpanel_save_new_page');
    });

    Route::prefix('media')->group(function(){
        Route::get('/', 'CPanelMediaController@index')->name('cpanel_all_media');
//        Route::delete('/{id}/delete', 'CPanelMediaController@deleteAjax')->name('cpanel_delete_media')->where('id', '[0-9]+');
//        Route::post('/new', 'CPanelMediaController@store')->name('cpanel_upload_media');
    });



});


Route::get('/', 'HomeController@index')->name('home');
Route::get('/unathorized', 'Auth\UserPermissionsController@index')->name('unathorized');




