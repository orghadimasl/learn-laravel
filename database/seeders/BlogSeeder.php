<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('blogs')->truncate();

        // for($i = 1; $i <= 100; $i++)
        // {
        //       DB::table('blogs')->insert([
        //     'title' => "Blog$i",
        //     'descripsi' => "Ini adalah deskripsi untuk blog $i",
        //     'user_id' => fake()->numberBetween(307, 406),
        // ]);
        // }
    }
}
