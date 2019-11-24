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
            'name' => 'said haiba',
            'email' => 'saidhaiba@gmail.com',
            'password' => bcrypt('123456789'),
            'role' => 1,
            'statut' => 1
        ]);
    }
}
