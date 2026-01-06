<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemSeeder extends Seeder
{
    public function run()
    {
        
        Item::create([
            'name' => 'Laptop ASUS ROG',
            'description' => 'Laptop spesifikasi tinggi.',
            'stock' => 10,
            'category_id' => 1 
        ]);

        Item::create([
            'name' => 'Proyektor Epson',
            'description' => 'Proyektor portable.',
            'stock' => 0,
            'category_id' => 1 
        ]);

        Item::create([
            'name' => 'Multimeter Fluke',
            'description' => 'Alat ukur tegangan presisi.',
            'stock' => 5,
            'category_id' => 2 
        ]);

        Item::create([
            'name' => 'Gelas Ukur 500ml',
            'description' => 'Gelas kaca Pyrex tahan panas.',
            'stock' => 20,
            'category_id' => 3 
        ]);
    }
}