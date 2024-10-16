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

Route::get('/', function () {
    return view('login');
});//->middleware('guest');
Route::post('/', [UserController::class, 'authenticate']);

Route::get('/register', function () {
    return view('register');
});
Route::post('/register', [UserController::class, 'store']);

Route::get('/home/{user:username}', function (User $user) {
    return view('home',["title"=>"January's Report", "user" => $user]);
});//->middleware('auth');

Route::get('/create-transaction', function () {
    return view('create-transaction',['title'=>'Create Transaction']);
});

Route::post('/logout', [UserController::class, 'logout']);

Route::get('/profile/{user:username}', function (User $user) {
    return view('profile',["user" => $user]);
});//->middleware('auth');