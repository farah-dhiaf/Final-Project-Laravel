<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        $colors = ["#1C64F2", "#16BDCA", "#9061F9"];

        // Mengirim data ke view
        // return view('home', [
        //     'categories' => $categories,
        //     'colors' => $colors
        // ]);
        return view('home', compact('categories', 'colors'));


    }
}
