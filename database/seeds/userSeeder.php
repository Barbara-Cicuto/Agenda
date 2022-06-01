<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;


class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::updateOrCreate([
            'name' => 'Bárbara',
            'email' => 'barbara@gmail.com',
            'password' => Hash::make('barbara')
        ], ['email' => 'barbara@gmail.com']);
    }
}
