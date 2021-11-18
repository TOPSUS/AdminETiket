<?php

use Illuminate\Database\Seeder;

class SuperAdmin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'nama'=>'deddy',
            'email'=>'deddy@gmail.com',
            'password'=>\Illuminate\Support\Facades\Hash::make('deddy12345'),
            'role'=>'SAdmin',
        ]);
    }
}
