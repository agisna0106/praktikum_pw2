<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'npm'       => 12345,
            'username'  => 'Chohan123',
            'first_name'=> 'Cho',
            'last_name' => 'Han',
            'email'     => 'chohan@gmail.com',
            'password'  => Hash::make('password')
        ]);
    }
}
