<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Category;


class TransactionController extends Controller
{
    public function filter(User $user, $year, $month)
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

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required|integer',
            'amount' => 'required|numeric',
            'description' => 'required',
            //  'password' => 'required|min:8|max:50|confirmed'
        ]);

        Transaction::create([
            'title' => $request['title'],
            'category_id' => $request->input('category_id', 1),
            'amount' => $request['amount'],
            'description' => $request['description'],
        ]);

        return redirect("/home/" . Auth::user()->username)->with('success', 'Transaction created successfully!');
    }

    public function createCategory()
    {
        $categories = Category::all(); 
        return view('create-outcome')->with('categories', $categories);
    }
    public function updateCategory()
    {
        $categories = Category::all();
        return view('update-outcome')->with('categories', $categories);
    }
    public function updateTransaction(Request $request)
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|numeric',
            'amount' => 'required|numeric',
            'description' => 'required|string',
        ]);

        $transaction = Transaction::find($request->input('id'));
        if (!$transaction) {
            return redirect()->back()->with('error', 'Transaction not found.');
        }

        DB::table('transactions')
            ->where('id', $transaction->id)
            ->update([
                'title' => $request->input('title'),
                'category_id' => $request->input('category_id', 1),
                'amount' => $request->input('amount'),
                'description' => $request->input('description'),
                'updated_at' => now()
            ]);
        // dd($result);

        return redirect("/home/" . Auth::user()->username)->with('success', 'Transaction updated successfully!');
    }
    

    public function deleteTransaction($id)
    {
        $transaction = Transaction::find($id);
    
        if (!$transaction) {
            return redirect()->back()->with('error', 'Transaction not found.');
        }
    
        $transaction->delete();
        return redirect()->back()->with('success', 'Transaction deleted successfully!');
    }
    

}
