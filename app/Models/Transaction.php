<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;
    protected $with = ['category'];
    protected $fillable = ['title', 'category_id', 'amount', 'description'];
    // protected $fillable = ['title', 'amount', 'description'];
    // protected $guarded = ['id','user_id', 'created_at', 'updated_at'];
    protected $guarded = ['id', 'created_at', 'updated_at'];

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

}

