<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
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
        Role::create(['name' => 'mahasiswa']);
        Role::create(['name' => 'pustakawan']);
        Permission::create(['name' => 'show book']);
        Permission::create(['name' => 'edit book', 'guard_name' => 'api']);

        $user = User::create([
            'npm'       => 5520123002,
            'username'  => 'Chohan123',
            'first_name'=> 'Cho',
            'last_name' => 'Han',
            'email'     => 'chohan@gmail.com',
            'password'  => Hash::make('password')
        ]);

        $user->assignRole('mahasiswa');
        $user->givePermissionTo('show book');
    }
}
