<?php

Route::get('/register/verify/{token}', 'AuthController@checkRegisterEmail')->name('equation');

Route::get('/{any?}', 'IndexController@index')->where('any', '^(?!api\/)[\/\w\.-]*')->name('index');
