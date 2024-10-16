<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Transaction;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Transaction::class;

    public function definition()
    {
        return [
            // 'user_id' => rand(1, 10), // Misalnya, jika ada 10 pengguna
            'title' => $this->faker->sentence,
            'category_id' => rand(1, 4), // Kategori antara 1 hingga 4
            'amount' => $this->faker->randomFloat(2, 2, 5), // Contoh jumlah antara 1000 hingga 10000
            'description' => $this->faker->text(10),
        ];
    }
}
