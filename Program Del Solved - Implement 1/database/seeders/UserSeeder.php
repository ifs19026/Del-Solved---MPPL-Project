<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        
        DB::table('users')->insert(
            [
                [
                    'name' => 'Alfrendo Silalahi',
                    'email' => 'alfrendo@gmail.com',
                    'password' => Hash::make('password'),
                    'is_admin' => 1
                ],
                [
                    'name' => 'Gunado Siregar',
                    'email' => 'gunado@gmail.com',
                    'password' => Hash::make('password'),
                    'is_admin' => 0
                ]
            ]
        );

    }
}
