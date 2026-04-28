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
        Role::create(['name' => 'mahasiswa2']);
        Role::create(['name' => 'pustakawan3']);
        Permission::create(['name' => 'show book','guard_name' => 'api']);
        Permission::create(['name' => 'edit book', 'guard_name' => 'api']);

        $user = User::create([
            'npm'       => 2220122004,
            'username'  => 'Udin',
            'first_name'=> 'Udin',
            'last_name' => 'Udin 2',
            'email'     => 'udin4@gmail.com',
            'password'  => bcrypt('password')
        ]);

        $user->assignRole('mahasiswa2');
        $user->givePermissionTo('show book');
    }
}
