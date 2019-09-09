<?php

Route::get('/{any?}', 'IndexController@index')->where('any', '^(?!api\/)[\/\w\.-]*')->name('index');
