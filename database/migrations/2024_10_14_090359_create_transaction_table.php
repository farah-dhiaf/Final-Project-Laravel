<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaction', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('user_id')->constrained('users', indexName: 'transaction_user_id');
            $table->foreignId('category_id')->constrained('categories', indexName: 'transaction_category_id');
            $table->foreignId('subcategory_id')->constrained('subcategories', indexName: 'transaction_subcategory_id');
            $table->float('amount');
            $table->text('description');     
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction');
    }
};
