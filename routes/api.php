<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['api']], function () {
    // Permissions
    //Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    //Route::apiResource('roles', 'RolesApiController');

    // Users
    //Route::apiResource('users', 'UsersApiController');

    // Ad
    Route::post('ads/media', 'AdApiController@storeMedia')->name('ads.storeMedia');
    Route::apiResource('ads', 'AdApiController');
});
