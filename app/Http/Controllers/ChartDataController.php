<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category; 
use App\Models\Transaction;

class ChartDataController extends Controller
{
    public function getChartData()
    {
        $data = Transaction::select('categories.name as category_name', \DB::raw('count(*) as total'))
            ->join('categories', 'transactions.category_id', '=', 'categories.id')
            ->where('transactions.category_id', '!=', 1)
            ->groupBy('categories.name')
            ->get();

        $labels = $data->pluck('category_name');
        $series = $data->pluck('total');

        return response()->json([
            'labels' => $labels,
            'series' => $series,
        ]);
    }
    public function getBarData()
    {
        $data = Transaction::select(
                \DB::raw('DATE_FORMAT(transactions.created_at, "%Y-%m") as month'), 
                \DB::raw('count(*) as total') 
            )
            ->where('transactions.category_id', '!=', 1) 
            ->groupBy('month') 
            ->orderBy('month') 
            ->get();
    
        $labels = $data->pluck('month');
        $series = $data->pluck('total');
    
        return response()->json([
            'labels' => $labels,
            'values' => $series,
        ]);
    }
    
}
