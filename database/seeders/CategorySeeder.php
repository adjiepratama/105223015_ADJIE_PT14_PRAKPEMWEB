<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
class CategorySeeder extends Seeder
{
    public function run()
    {
        // Masukkan data kategori statis disini
        Category::create(['name' => 'Elektronik']);
        Category::create(['name' => 'Alat Ukur']);
        Category::create(['name' => 'Alat Laboratorium']);
        Category::create(['name' => 'Aksesoris Komputer']);
    }
}