<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Iqbal Salim',
                'email' => 'iqbalbinsalim@gmail.com',
                'password' => 'password',
                'role' => 'admin',
            ],
            [
                'name' => 'Pimpinan',
                'email' => 'pimpinan@gmail.com',
                'password' => 'password',
                'role' => 'pimpinan',
            ],
            [
                'name' => 'Operator',
                'email' => 'operator@gmail.com',
                'password' => 'password',
                'role' => 'operator',
            ],
        ];

        foreach ($users as $row) {
            $user = User::create([
                'name' => $row['name'],
                'email' => $row['email'],
                'password' => Hash::make($row['password']),
            ]);

            $user->assignRole($row['role']);
        }

        // $permission = Permission::create(['name' => 'crud usulan']);
        // $role = Role::where('name', 'sekretaris')->first();
        // $permission = Permission::where('name', 'crud usulan')->first();
        // $permission->assignRole($role);
    }
}
