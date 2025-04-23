<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'=>'admin',
            'email'=> 'admin.admin@gmail.com',
            'email_verified_at' => now(),
            'password'=> bcrypt('admin'),
        ])->assignRole('superadmin');

        User::create([
            'name'=>'Jose Daniel Grijalba Osorio',
            'email'=> 'jose.jdgo97@gmail.com',
            'email_verified_at' => now(),
            'password'=> bcrypt('123123123'),
        ])->assignRole('admin');


        User::create([
            'name'=>'Juan David Grijalba Osorio',
            'email'=> 'juandavidgo1997@gmail.com',
            'email_verified_at' => now(),
            'password'=> bcrypt('123123123'),
        ])->assignRole('staff');

        User::create([
            'name'=>'Hebron staff',
            'email'=> 'hebron.customer@gmail.com',
            'email_verified_at' => now(),
            'password'=> bcrypt('123123123'),
        ])->assignRole('staff');

        User::create([
            'name'=>'Mario',
            'email'=> 'mario@gmail.com',
            'email_verified_at' => now(),
            'password'=> bcrypt('123123123'),
        ])->assignRole('staff');

        User::create([
            'name'=>'Alejandro',
            'email'=> 'alejo@gmail.com',
            'email_verified_at' => now(),
            'password'=> bcrypt('123123123'),
        ])->assignRole('staff');
        User::create([
            'name'=>'Luigi Mangione',
            'email'=> 'luigi7@gmail.com',
            'email_verified_at' => now(),
            'password'=> bcrypt('123123123'),
        ])->assignRole('staff');

        User::factory(9)->create();
    }
}
