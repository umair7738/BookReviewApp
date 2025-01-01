<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Book::insert([
            [
                'title' => 'Book A',
                'description' => 'Description for Book A',
                'author' => 'Author 1',
                'genre' => 'Fiction',
                'published_date' => '2025-01-01',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Book B',
                'description' => 'Description for Book B',
                'author' => 'Author 2',
                'genre' => 'Non-Fiction',
                'published_date' => '2024-05-15',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
    
}
