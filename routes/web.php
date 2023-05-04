<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::group(['prefix' => 'install', 'namespace' => 'Install', 'as' => 'install.'], function () {
    Route::get('purchase-code', 'PurchaseCodeController@index')->name('get-purchase-code');
    Route::post('purchase-code', 'PurchaseCodeController@verify')->name('set-purchase-code');
});


Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'backend_permission'], 'namespace' => 'Admin', 'as' => 'admin.'], function () {

    Route::get('/', 'DashboardController@index')->name('index');
    Route::get('dashboard', 'DashboardController@index')->name('dashboard.index');

    Route::get('profile', 'ProfileController@index')->name('profile.index');
    Route::post('profile', 'ProfileController@update')->name('profile.update');

    Route::get('conversation/{id?}', 'ConversationController@index')->name('conversation.index');
    Route::get('get-conversation', 'ConversationController@getConversation')->name('conversation.get-conversation');
    Route::post('set-conversation', 'ConversationController@setConversation')->name('conversation.set-conversation');
    Route::get('get-user', 'ConversationController@getUser')->name('conversation.get-user');

    Route::resource('ticket', 'TicketController');
    Route::get('ticket/download/{id}', 'TicketController@download')->name('ticket.download');
    Route::post('ticket/change-status', 'TicketController@changeStatus')->name('ticket.changestatus');

    Route::resource('faq', 'FaqController');
    Route::resource('category', 'CategoryController');
    Route::resource('user', 'UserController');

    Route::resource('role', 'RoleController')->except(['show']);
    Route::get('permission/{id?}', 'PermissionController@index')->name('permission.index');
    Route::post('permission/{id}', 'PermissionController@savePermission')->name('permission.save');

    Route::get('setting', 'SettingController@index')->name('setting.index');
    Route::post('setting', 'SettingController@store')->name('setting.store');
});

Route::group(['namespace' => 'Frontend', 'as' => 'frontend.'], function () {

    Route::get('/', 'SiteController@index')->name('index');

    Route::get('ticket', 'TicketController@index')->name('ticket');
    Route::post('ticket', 'TicketController@store')->name('ticket.store');

    Route::get('faq', 'FaqController@index')->name('faq');
    Route::get('contact', 'ContactController@index')->name('contact');

    Route::group(['middleware' => 'auth'], function () {

        Route::group(['prefix' => 'myticket', 'as' => 'myticket.'], function () {
            Route::get('/', 'MyTicketController@index')->name('index');
            Route::post('/', 'MyTicketController@store')->name('store');
            Route::get('{id}/show', 'MyTicketController@show')->name('show');
            Route::get('{id}/edit', 'MyTicketController@edit')->name('edit');
            Route::put('{id}/update', 'MyTicketController@update')->name('update');
            Route::delete('{id}/delete', 'MyTicketController@delete')->name('delete');
            Route::get('{id}/download', 'MyTicketController@download')->name('download');
        });

        Route::get('livechat', 'LiveChatController@index')->name('livechat.index');
        Route::get('get-livechat', 'LiveChatController@getLiveChat')->name('livechat.get-livechat');
        Route::post('set-livechat', 'LiveChatController@setLiveChat')->name('livechat.set-livechat');

        Route::post('save-device-token', 'SiteController@saveDeviceToken')->name('save-device-token');
    });
});

Route::get('test', 'TestController@index');
