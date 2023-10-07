<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Category::create([
        //     "name" => [
        //         "uz" => 'Fantastika',
        //         "en" => 'Fantasy',
        //     ]
        // ]);
        // Category::create([
        //     "name" => [
        //         "uz" => 'Sarguzasht',
        //         "en" => 'Action and Advanture',
        //     ]
        // ]);
        // Category::create([
        //     "name" => [
        //         "uz" => 'Detektiv',
        //         "en" => 'Detective and Mystery',
        //     ]
        // ]);
        // Category::create([
        //     "name" => [
        //         "uz" => 'Badiy',
        //         "en" => 'Literary Fiction',
        //     ]
        // ]);
        // Category::create([
        //     "name" => [
        //         "uz" => 'Tarixiy',
        //         "en" => 'Historical Fiction',
        //     ]
        // ]);
          Category::create([
            "name" =>'Fantasy'
        ]);
        Category::create([
            "name" =>'Action and Advanture',
        ]);
        Category::create([
            "name" =>'Detective and Mystery',
        ]);
        Category::create([
            "name" =>'Literary Fiction',
        ]);
        Category::create([
            "name" =>'Historical Fiction',
        ]);
    }
}
