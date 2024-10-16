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
        $categories = Category::all(); // Ambil semua data dari tabel category
        return view('create-outcome')->with('categories', $categories);
    }
    public function show($id)
    {
        // Coba temukan transaksi dengan ID
        $transaction = Transaction::find($id);

        // Jika tidak ditemukan, arahkan kembali dengan pesan error
        if (!$transaction) {
            return redirect()->back()->with('error', 'Transaction not found.');
        }

        // Kembalikan view dengan transaksi
        return view('transactions.show', compact('transaction'));
    }
    public function updateTransaction(Request $request)
    {
        // Validasi input dari form
        // Auth::id() = Auth::id();
        $request->validate([
            // 'user_id' => Auth::id(),
            'id' => 'required|numeric',
            'title' => 'required|string|max:255',
            'category_id' => 'nullable|numeric',
            'amount' => 'required|numeric',
            'description' => 'required|text',
        ]);

        $transaction = Transaction::find($request->input('id'));

        if (!$transaction) {
            return redirect()->back()->with('error', 'Transaction not found.');
        }

        DB::table('transactions')
            ->where('id')
            ->update([
                // 'user_id' => Auth::id(),
                'title' => $request->input('title'),
                'category_id' => $request->input('category_id'),
                'amount' => $request->input('amount'),
                'description' => $request->input('description'),
                'updated_at' => now() // Pastikan timestamp ter-update
            ]);

        // Redirect kembali dengan pesan sukses
        return redirect("/home/" . Auth::user()->username)->with('success', 'Transaction updated successfully!');
    }



    public function deleteTransaction()
    {
        // Ambil user yang sedang login
        // $user = Auth::user();

        // Hapus user dari database
        DB::table('transactions')
            ->where('id')
            ->delete();

        // Logout setelah menghapus user
        // Auth::logout();

        // Redirect ke halaman utama dengan pesan sukses
        return redirect("/home/" . Auth::user()->username)->with('success', 'Transaction deleted successfully!');
    }

    public function showChart()
    {
        // Ambil transaksi yang category_id-nya bukan 1 beserta kategori
        $transactions = Transaction::with('category')
            ->where('category_id', '!=', 1)
            ->get();
        
        // Persiapkan data untuk chart
        $data = [
            'labels' => $transactions->pluck('category.name'), // Ambil nama kategori
            'amounts' => $transactions->pluck('amount'), // Jumlah transaksi
        ];
    
        return view('pie-chart', compact('data'));
    }
}
