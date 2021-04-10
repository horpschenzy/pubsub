<?php

use App\Models\Subscriber;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return Subscriber::all();
});

Route::post('/subscribe/{topic}', ['App\Http\Controllers\SubcriberController', 'store']);
Route::post('/publish/{topic}', ['App\Http\Controllers\PublisherController', 'publish']);

