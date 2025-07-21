<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'      => 'Wessam Khalil',
            'email'     => 'wessam@combal.net',
            'password'  => Hash::make('135=@n&W')
        ]);

        User::create([
            'name'      => 'Nabil Alyaqoub',
            'email'     => 'nabil@zawaya-group.com',
            'password'  => Hash::make('135=@Nabil')
        ]);

    }
}
