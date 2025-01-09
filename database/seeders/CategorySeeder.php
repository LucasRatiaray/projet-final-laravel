<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Salon',
            'Salle à manger',
            'Chambre',
            'Bureau',
            'Cuisine',
            'Salle de bain',
            'Jardin',
            'Entrée',
            'Dressing',
            'Autre',
        ];

        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }
    }
}
