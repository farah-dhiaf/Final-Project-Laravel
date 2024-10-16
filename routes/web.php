<?php

use App\Http\Controllers\ProfileController;
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
Route::post('/', [User::class, 'authenticate']);

Route::get('/register', function () {
    return view('register');
});
Route::post('/register', [User::class, 'store']);

Route::get('/home/{user:username}', function (User $user) {
    return view('home',["title"=>"January's Report", "user" => $user]);
});//->middleware('auth');

Route::get('/create-transaction', function () {
    return view('create-transaction',['title'=>'Create Transaction']);
});

Route::post('/logout', [User::class, 'logout']);

Route::get('/profile/{user:username}', function (User $user) {
    return view('profile',["user" => $user]);
});//->middleware('auth');
Route::get('/profile/{user:username}/update', function (User $user) {
    return view('update-profile',["user" => $user]);
});
Route::get('/profile/{user:username}/delete', function (User $user) {
    return view('delete-profile',["user" => $user]);
});
Route::put('/profile', [User::class, 'updateProfile']);
Route::delete('/profile', [User::class, 'deleteProfile']);
