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
        ]);
        DB::table('categories')->insert([
            'name' => 'Viandes Volailles et Oeufs',
        ]);
        DB::table('categories')->insert([
            'name' => 'Laits & Fromages',
        ]);
        DB::table('categories')->insert([
            'name' => 'Boissons & Alcools',
        ]);
    }
}
