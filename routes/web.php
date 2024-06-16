<?php

use Illuminate\Support\Facades\Route;

Route::get('/set-redis', function () {
    \Illuminate\Support\Facades\Redis::set('user:1:first_name', 'hadid1');
    \Illuminate\Support\Facades\Redis::set('user:2:first_name', 'hadid2');
    \Illuminate\Support\Facades\Redis::set('user:3:first_name', 'hadid3');
//    return view('welcome');
});

Route::get('/get-redis', function () {
    dd( \Illuminate\Support\Facades\Redis::get('user:1:first_name'));
//    \Illuminate\Support\Facades\Redis::get('user:2');
//    \Illuminate\Support\Facades\Redis::get('user:3');
//    return view('welcome');
});
