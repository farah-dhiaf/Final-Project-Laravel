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
    protected $fillable = ['title', 'category_id', 'amount', 'description'];
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

    public function scopeFilter(Builder $query, array $filters): void
    {
        $query->when(
            $filters['user'] ?? false, 
            fn ($query, $user) =>
            $query->whereHas('user', fn($query) => $query->where('username', $user))
        );

        $query->when(
            $filters['month'] ?? false, 
            fn ($query, $month) =>
            $query->whereMonth('created_at', $month)
        );
        
        $query->when(
            $filters['year'] ?? false, 
            fn ($query, $year) =>
            $query->whereYear('created_at', $year)
        );

    }
}

