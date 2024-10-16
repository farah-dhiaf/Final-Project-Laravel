<?php

// use App\Models\Category;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Transaction;
use App\Model\Category;
use App\Model\Subcategory;
use App\Models\User;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TransactionController;

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

// register
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


//income
Route::get('/income/create', function () {
    return view('create-income',['title'=>'Add Income']);
});
Route::post('/income/create', [TransactionController::class, 'store']);
Route::get('/income/{transaction:id}', function (User $user, Transaction $transaction) {
    return view('update-income',['title'=>'Update Income']);
});
Route::put('/income/{transaction:id}', [TransactionController::class, 'updateTransaction']);
Route::delete('/income/{transaction:id}', [TransactionController::class, 'deleteTransaction']);


//outcome
Route::get('/outcome/create', function (User $user) {
    return view('create-outcome',['title'=>'Add Outcome']);
});
Route::post('/outcome/create', [TransactionController::class, 'store']);
Route::get('/outcome/{transaction:id}', function (User $user, Transaction $transaction) {
    return view('update-outcome',['title'=>'Update Outcome']);
});
Route::put('/outcome/{transaction:id}', [TransactionController::class, 'updateTransaction']);
Route::delete('/outcome/{transaction:id}', [TransactionController::class, 'deleteTransaction']);
Route::get('/outcome/create', [TransactionController::class, 'createCategory']);


Route::post('/logout', [UserController::class, 'logout']);

Route::get('/profile/{user:username}', function (User $user) {
    return view('profile',["user" => $user]);
});//->middleware('auth');
Route::get('/profile/{user:username}/update', function (User $user) {
    return view('update-profile',["user" => $user]);
});
Route::get('/profile/{user:username}/delete', function (User $user) {
    return view('delete-profile',["user" => $user]);
});
Route::put('/profile', [UserController::class, 'updateProfile']);
Route::delete('/profile', [UserController::class, 'deleteProfile']);

Route::get('/income/{user:username}', function (User $user, Transaction $transaction) {
    return view('income',["user" => $user, 'transactions' => $transaction]);
});


Route::get('/outcome/{user:username}', function (User $user, Transaction $transaction) {
    return view('outcome',["user" => $user, 'transactions' => $transaction]);
});

