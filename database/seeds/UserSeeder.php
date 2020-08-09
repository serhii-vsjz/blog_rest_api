<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User([
            'name' => 'user',
            'email' => 'user@mail.com',
            'password' => Hash::make('password'),
        ]);

        $user->save();

        factory(User::class, 4)->create();
    }
}
