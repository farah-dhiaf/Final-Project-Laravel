<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\User;

class TransactionController extends Controller
{
    public function show(User $user, $year, $month)
    {
        $validatedYear = intval($year);
        $validatedMonth = intval($month);
        
        $transactions = Transaction::whereYear('created_at', $validatedYear)
                                   ->whereMonth('created_at', $validatedMonth)
                                   ->where('user_id', $user->id);
    
        return view('home', [
            "title" => "{$month}'s Report {$year}",
            "user" => $user,
            'transactions' => $transactions,
            'year' => $validatedYear,
            'month' => $validatedMonth
        ]);
    }

}
