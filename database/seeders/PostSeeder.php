<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // You can loop to generate multiple records
        for ($i = 1; $i <= 10; $i++) {
            Post::create([
                'title' => "Generated Task $i",
                'priority' => ['low', 'medium', 'high'][array_rand(['low', 'medium', 'high'])],
                'due_date' => now()->addDays(rand(1, 30))->toDateString(),
            ]);
        }
    }
}
