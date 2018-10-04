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
            'name' => 'Volailles',
        ]);
        DB::table('categories')->insert([
            'name' => 'Oeufs',
        ]);
        DB::table('categories')->insert([
            'name' => 'Laits & Fromages',
        ]);
        DB::table('categories')->insert([
            'name' => 'Charcuterie',
        ]);
        DB::table('categories')->insert([
            'name' => 'Boucherie',
        ]);
        DB::table('categories')->insert([
            'name' => 'Textiles',
        ]);
        DB::table('categories')->insert([
            'name' => 'Autres',
        ]);
    }
}
