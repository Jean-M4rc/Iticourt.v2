<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name' => 'Fruits & Légumes',
            'created_at' => now(),
        ]);
        DB::table('categories')->insert([
            'name' => 'Viandes & Oeufs',
            'created_at' => now(),
        ]);
        DB::table('categories')->insert([
            'name' => 'Laits & Fromages',
            'created_at' => now(),
        ]);
        DB::table('categories')->insert([
            'name' => 'Boissons & Alcools',
            'created_at' => now(),
        ]);
    }
}
