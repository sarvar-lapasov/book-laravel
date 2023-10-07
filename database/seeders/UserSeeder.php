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
           'username'=> 'Molly',
           'email' => 'molly@mail.ru',
            'password' => Hash::make('secret'),
        ]);

       $admin->roles()->attach(1);

       User::factory()->count(4)->hasAttached(Role::find(2))->create();

           $admin2 = User::create([
           'username'=> 'Sarvar',
           'email' => 's@mail.ru',
            'password' => Hash::make('string'),
        ]);

       $admin2->roles()->attach(1);
       $admin2->roles()->attach(3);
    }
}
