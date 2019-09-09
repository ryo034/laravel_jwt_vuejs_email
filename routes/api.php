<?php

use Illuminate\Http\Request;

Route::prefix('auth')->group(function () {
  Route::post('register', 'AuthController@register');
  Route::post('login', 'AuthController@login');
  // Refresh the JWT Token
  Route::get('refresh', 'AuthController@refresh');
  Route::middleware('auth:api')->group(function () {
      // Get user info
      Route::get('user', 'AuthController@user');
      // Logout user from application
      Route::post('logout', 'AuthController@logout');
  });
});
