<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'control-panel::show')->name('control-panel');

Route::view('/server-information', 'control-panel::server-information')->name('server-information');

Route::view('/php-info', 'control-panel::php-info')->name('php-info');
