<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::firstOrCreate(
            ['email' => 'admin@perpustakaan.com'],
            [
                'name' => 'Admin Perpustakaan',
                'password' => \Illuminate\Support\Facades\Hash::make('password123'),
            ]
        );

        if (\App\Models\Book::count() === 0) {
            \App\Models\Book::create([
                'title' => 'Clean Code: A Handbook of Agile Software Craftsmanship',
                'author' => 'Robert C. Martin',
                'isbn' => '978-0-13-235088-4',
                'publisher' => 'Prentice Hall',
                'year' => 2008,
                'description' => 'Buku standar industri tentang penulisan kode yang bersih, mudah dirawat, dan teruji.'
            ]);

            \App\Models\Book::create([
                'title' => 'Design Patterns: Elements of Reusable Object-Oriented Software',
                'author' => 'Erich Gamma, Richard Helm, Ralph Johnson, John Vlissides',
                'isbn' => '978-0-20-163361-0',
                'publisher' => 'Addison-Wesley',
                'year' => 1994,
                'description' => 'Buku klasik Gang of Four mengenai pola desain berorientasi objek.'
            ]);

            \App\Models\Book::create([
                'title' => 'Continuous Delivery: Reliable Software Releases through Build, Test, and Deployment Automation',
                'author' => 'Jez Humble, David Farley',
                'isbn' => '978-0-32-160191-9',
                'publisher' => 'Addison-Wesley',
                'year' => 2010,
                'description' => 'Panduan komprehensif tentang otomatisasi pipeline CI/CD dan deployment modern.'
            ]);
        }
    }
}
