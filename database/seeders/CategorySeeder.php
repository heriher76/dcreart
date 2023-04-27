<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categorys = ['facades', 'contemporary'];

        for ($i=0; $i < count($categorys); $i++) { 
           \App\Models\Category::create([
                'name' => $categorys[$i]
           ]);
        }
    }
}
