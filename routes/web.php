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
use App\Http\Controllers\SummaryController;

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
Route::post('/', [UserController::class, 'authenticate']);//->middleware('guest');

Route::get('/register', function () {
    return view('register');
});//->middleware('guest');
Route::post('/register', [UserController::class, 'store']);//->middleware('guest');

// Route::get('/home/{user:username}/{year}/{month}', [TransactionController::class, 'show']);//->middleware('auth');

Route::get('/home/{user:username}', function (User $user) {
    $month = request('month', now()->month);
    $year = request('year', now()->year);
    
    $totalIncome = Transaction::totalIncome($month, $year);
    $totalOutcome = Transaction::totalOutcome($month, $year);

    return view('home', [
        'title' => 'Report in ' . date('F', mktime(0, 0, 0, $month, 10)) . ' ' . $year,
        'user' => $user,
        'year' => $year,
        'month' => $month,
        'totalIncome' => $totalIncome,
        'totalOutcome' => $totalOutcome,
        'diff' => $totalIncome - $totalOutcome
    ]); 
});


//income
Route::get('/income/create', function () {
    return view('create-income',['title'=>'Add Income']);
});
Route::post('/income/create', [TransactionController::class, 'store']);
Route::get('/income/update/{transaction:id}', function (Transaction $transaction) {
    return view('update-income',['transaction' => $transaction]);
});
Route::put('/income/update/{transaction:id}', [TransactionController::class, 'updateTransaction']);
Route::delete('/income/delete/{transaction:id}', [TransactionController::class, 'deleteTransaction']);

//outcome
Route::get('/outcome/create', function (User $user) {
    return view('create-outcome',['title'=>'Add Outcome']);
});
Route::post('/outcome/create', [TransactionController::class, 'store']);
Route::get('/outcome/update/{transaction:id}', function (Transaction $transaction) {// Akan menampilkan 404 jika tidak ditemukan
    return view('update-outcome', ['transaction' => $transaction]);
});
Route::put('/outcome/update/{transaction:id}', [TransactionController::class, 'updateTransaction']);
Route::delete('/outcome/delete/{transaction:id}', [TransactionController::class, 'deleteTransaction']);
Route::get('/outcome/create', [TransactionController::class, 'createCategory']);
Route::get('/outcome/update/{transaction:id}', [TransactionController::class, 'updateCategory']);


Route::post('/logout', [UserController::class, 'logout']);//->middleware('auth');

Route::get('/profile/{user:username}', function (User $user) {
    return view('profile',["user" => $user]);
});//->middleware('auth');
Route::get('/profile/{user:username}/update', function (User $user) {
    return view('update-profile',["user" => $user]);
});//->middleware('auth');
Route::get('/profile/{user:username}/delete', function (User $user) {
    return view('delete-profile',["user" => $user]);
});//->middleware('auth');
Route::put('/profile', [UserController::class, 'updateProfile']);//->middleware('auth');
Route::delete('/profile', [UserController::class, 'deleteProfile']);//->middleware('auth');

Route::get('/income/{user:username}', function (User $user) {
    $month = request('month', now()->month);
    $year = request('year', now()->year);
    
    $totalIncome = Transaction::totalIncome($month, $year);
    $totalOutcome = Transaction::totalOutcome($month, $year);

    return view('income', [
        'title' => 'Report in ' . date('F', mktime(0, 0, 0, $month, 10)) . ' ' . $year,
        'user' => $user,
        'year' => $year,
        'month' => $month,
        'totalIncome' => $totalIncome,
        'totalOutcome' => $totalOutcome,
        'diff' => $totalIncome - $totalOutcome,
        'transactions' => Transaction::with('category') // Eager loading 'category'
                            ->where('category_id', 1)
                            ->whereYear('created_at', $year) // Filter berdasarkan tahun
                            ->whereMonth('created_at', $month)
                            ->paginate(10)
    ]);    
});//->middleware('auth');

Route::get('/outcome/{user:username}', function (User $user) {
    $month = request('month', now()->month);
    $year = request('year', now()->year);
    
    $totalIncome = Transaction::totalIncome($month, $year);
    $totalOutcome = Transaction::totalOutcome($month, $year);

    return view('outcome', [
        'title' => 'Report in ' . date('F', mktime(0, 0, 0, $month, 10)) . ' ' . $year,
        'user' => $user,
        'year' => $year,
        'month' => $month,
        'totalIncome' => $totalIncome,
        'totalOutcome' => $totalOutcome,
        'diff' => $totalIncome - $totalOutcome,
        'transactions' => Transaction::with('category') // Eager loading 'category'
                            ->where('category_id', '!=', 1) // Menampilkan selain category_id 1
                            ->whereYear('created_at', $year) // Filter berdasarkan tahun
                            ->whereMonth('created_at', $month)
                            ->paginate(10) // Pagination 10 items per page
    ]);
});//->middleware('auth');
