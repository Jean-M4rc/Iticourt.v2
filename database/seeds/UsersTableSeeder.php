<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'nickname' => 'Administrateur',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('azerty'),
            'admin' => '1',
        ]);
    }
}
