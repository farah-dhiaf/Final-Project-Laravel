<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
use App\Models\User;

class Transaction extends Model
{
    use HasFactory;
    protected $with = ['category'];
    protected $fillable = ['title', 'category_id', 'amount', 'description', 'updated_at'];
    // protected $fillable = ['title', 'amount', 'description'];
    // protected $guarded = ['id','user_id', 'created_at', 'updated_at'];
    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $table = 'transactions';

    protected $casts = [
        'id' => 'integer',
        // 'user_id' => 'integer',
        'title' => 'string',
        // 'category_id' => 'integer',
        'amount' => 'decimal:2',
        'description' => 'string',

    ];

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public static function totalIncome($month, $year)
    {
        // Menghitung total income berdasarkan kategori income (category_id = 1)
        return self::where('category_id', '=', 1) // Filter kategori income
                   ->whereYear('created_at', $year) // Filter berdasarkan tahun
                   ->whereMonth('created_at', $month) // Filter berdasarkan bulan
                   ->sum('amount'); // Menjumlahkan kolom amount
    }

    public static function totalOutcome($month, $year)
    {
        // Menghitung total income berdasarkan kategori income (category_id = 1)
        return self::where('category_id', '!=', 1) 
                    ->whereYear('created_at', $year) 
                    ->whereMonth('created_at', $month)
                    ->sum('amount');
    }
}

