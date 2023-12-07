<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

       $admin = User::create([
           'username'=> 'Milena',
           'email' => 'molly@mail.ru',
            'password' => Hash::make('secret'),
        ]);

       $admin->roles()->attach(1);
       
       $user = User::create([
           'username'=> 'Billy',
           'email' => 'mike@mail.ru',
            'password' => Hash::make('12345678'),
        ]);

       $user->roles()->attach(2);

       User::factory()->count(4)->hasAttached(Role::find(2))->create();

           $creator = User::create([
           'username'=> 'Sarvar',
           'email' => 's@mail.ru',
            'password' => Hash::make('string'),
        ]);

       $creator->roles()->attach(1);
       $creator->roles()->attach(3);
    }
}
