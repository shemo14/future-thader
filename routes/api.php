<?php
use Illuminate\Support\Facades\Route;

Route::get('/load-users', 'Admin\UsersController@loadUsers')->name('api.load-users');