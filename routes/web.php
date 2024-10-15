<?php

use Illuminate\Support\Facades\Route;
use App\Model\Transaction;
use App\Model\Category;
use App\Model\Subcategory;
use App\Models\User;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/home', function () {
    return view('home',["title"=>"January's Report"]);
});

Route::get('/create-transaction', function () {
    return view('create-transaction',['title'=>'Create Transaction']);
});

Route::get('/', function () {
    return view('login');
});

Route::post('/', [UserController::class, 'authenticate']);

Route::get('/register', function () {
    return view('register');
});

Route::post('/register', [UserController::class, 'store']);