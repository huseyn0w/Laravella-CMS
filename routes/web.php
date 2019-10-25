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
Route::prefix('cpanel')->middleware(['auth', 'see_admin_panel'])->namespace('cpanel')->group(function () {

    Route::get('/', 'CPanelHomeController@index')->name('cpanel_home');

    Route::prefix('general-settings')->middleware('manage_general_settings')->group(function(){
        Route::get('/', 'CPanelGeneralSettingController@index')->name('cpanel_general_settings');
        Route::post('/', 'CPanelGeneralSettingController@store')->name('cpanel_update_general_settings');
    });



    Route::prefix('myprofile')->group(function(){
        Route::get('/', 'CPanelUsersController@editUser')->name('cpanel_myprofile');
    });

    Route::prefix('users')->middleware('manage_users')->group(function(){
        Route::get('/', 'CPanelUsersController@index')->name('cpanel_all_users_list');
        Route::get('/{id}', 'CPanelUsersController@editUser')->name('cpanel_edit_user_profile')->where('id', '[0-9]+');
        Route::put('/{id}/update', 'CPanelUsersController@updateUser')->name('cpanel_update_user_profile')->where('id', '[0-9]+');
        Route::delete('/{id}/delete', 'CPanelUsersController@deleteAjax')->name('cpanel_delete_user')->where('id', '[0-9]+');
        Route::delete('/multipleDelete', 'CPanelUsersController@multipleDelete')->name('cpanel_users_bulk_delete');
        Route::get('/new', 'CPanelUsersController@addUser')->name('cpanel_add_new_user');
        Route::post('/new', 'CPanelUsersController@createUser')->name('cpanel_save_new_user');
    });


    Route::prefix('roles')->middleware('manage_roles')->group(function(){
        Route::get('/', 'CPanelRoleController@index')->name('cpanel_user_roles');
        Route::get('/{id}', 'CPanelRoleController@editRole')->name('cpanel_edit_user_role')->where('id', '[0-9]+');
        Route::put('/{id}/update', 'CPanelRoleController@updateRole')->name('cpanel_update_user_role')->where('id', '[0-9]+');
        Route::delete('/{id}/delete', 'CPanelRoleController@deleteAjax')->name('cpanel_delete_user_role')->where('id', '[0-9]+');
        Route::get('/new', 'CPanelRoleController@addRole')->name('cpanel_add_user_role');
        Route::post('/new', 'CPanelRoleController@createRole')->name('cpanel_save_user_role');
    });

    Route::prefix('pages')->middleware('manage_pages')->group(function(){
        Route::get('/', 'CPanelPageController@index')->name('cpanel_pages_list');
        Route::get('/{id}', 'CPanelPageController@editPage')->name('cpanel_edit_page')->where('id', '[0-9]+');
        Route::put('/{id}/update', 'CPanelPageController@updatePage')->name('cpanel_update_page')->where('id', '[0-9]+');
        Route::delete('/multipleDelete', 'CPanelPageController@multipleDelete')->name('cpanel_pages_bulk_delete');
        Route::delete('/{id}/delete', 'CPanelPageController@deleteAjax')->name('cpanel_ajax_soft_delete_page')->where('id', '[0-9]+');
        Route::delete('/multipleDelete', 'CPanelPageController@multipleDelete')->name('cpanel_pages_bulk_delete');
        Route::get('/new', 'CPanelPageController@addPage')->name('cpanel_add_new_page');
        Route::post('/new', 'CPanelPageController@createPage')->name('cpanel_save_new_page');
    });

    Route::prefix('categories')->middleware('manage_categories')->group(function(){
        Route::get('/', 'CPanelCategoryController@index')->name('cpanel_category_list');
        Route::get('/{id}', 'CPanelCategoryController@edit')->name('cpanel_edit_category')->where('id', '[0-9]+');
        Route::put('/{id}/update', 'CPanelCategoryController@updateCategory')->name('cpanel_update_category')->where('id', '[0-9]+');
        Route::delete('/multipleDelete', 'CPanelCategoryController@multipleDelete')->name('cpanel_category_bulk_delete');
        Route::delete('/{id}/delete', 'CPanelCategoryController@deleteAjax')->name('cpanel_ajax_soft_delete_category')->where('id', '[0-9]+');
        Route::delete('/multipleDelete', 'CPanelCategoryController@multipleDelete')->name('cpanel_category_bulk_delete');
        Route::get('/new', 'CPanelCategoryController@addCategory')->name('cpanel_add_new_category');
        Route::post('/new', 'CPanelCategoryController@createCategory')->name('cpanel_save_new_category');
    });

    Route::prefix('posts')->middleware('manage_posts')->group(function(){
        Route::get('/', 'CPanelPostController@index')->name('cpanel_posts_list');
        Route::get('/trashed', 'CPanelPostController@trashedPosts')->name('cpanel_trashed_posts_list');
        Route::get('/{id}', 'CPanelPostController@editPost')->name('cpanel_edit_post')->where('id', '[0-9]+');
        Route::put('/{id}/update', 'CPanelPostController@updatePost')->name('cpanel_update_post')->where('id', '[0-9]+');
        Route::get('/{id}/restore', 'CPanelPostController@restore')->name('cpanel_restore_post')->where('id', '[0-9]+');
        Route::delete('/{id}/destroy', 'CPanelPostController@destroyAjax')->name('cpanel_destroy_post')->where('id', '[0-9]+');
        Route::delete('/multipleDelete', 'CPanelPostController@multipleDelete')->name('cpanel_posts_bulk_delete');
        //Route::delete('/multipleDestroy', 'CPanelPostController@multipleDestroy')->name('cpanel_posts_bulk_action');
        Route::post('/multiple', 'CPanelPostController@multipleActions')->name('cpanel_posts_bulk_action');
        Route::delete('/{id}/delete', 'CPanelPostController@deleteAjax')->name('cpanel_ajax_soft_delete_post')->where('id', '[0-9]+');
        Route::delete('/multipleDelete', 'CPanelPostController@multipleDelete')->name('cpanel_posts_bulk_delete');
        Route::get('/new', 'CPanelPostController@addPost')->name('cpanel_add_new_post');
        Route::post('/new', 'CPanelPostController@createPost')->name('cpanel_save_new_post');
    });

    Route::prefix('menus')->middleware('manage_menus')->group(function(){
        Route::get('/', 'CPanelMenuController@index')->name('cpanel_menu_list');
        Route::get('/{id}', 'CPanelMenuController@editMenu')->name('cpanel_edit_menu')->where('id', '[0-9]+');
        Route::put('/{id}/update', 'CPanelMenuController@updateMenu')->name('cpanel_update_menu')->where('id', '[0-9]+');
        Route::delete('/multipleDelete', 'CPanelMenuController@multipleDelete')->name('cpanel_menus_bulk_delete');
        Route::delete('/{id}/delete', 'CPanelMenuController@deleteAjax')->name('cpanel_ajax_soft_delete_menu')->where('id', '[0-9]+');
        Route::delete('/multipleDelete', 'CPanelMenuController@multipleDelete')->name('cpanel_menus_bulk_delete');
        Route::get('/new', 'CPanelMenuController@addMenu')->name('cpanel_add_new_menu');
        Route::post('/new', 'CPanelMenuController@createMenu')->name('cpanel_save_new_menu');
    });

    Route::prefix('media')->group(function(){
        Route::get('/', 'CPanelMediaController@index')->name('cpanel_all_media');
//        Route::delete('/{id}/delete', 'CPanelMediaController@deleteAjax')->name('cpanel_delete_media')->where('id', '[0-9]+');
//        Route::post('/new', 'CPanelMediaController@store')->name('cpanel_upload_media');
    });

});

Route::get('/{slug?}', 'PagesController@index')->name('front_pages');
Route::get('/posts/{slug}', 'PostsController@index')->name('posts');








