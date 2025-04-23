<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {  
        $role0 = Role::create(['name'=>'superadmin']);
        $role1 = Role::create(['name'=>'admin']);
        $role2 = Role::create(['name'=>'staff']);
        $role4 = Role::create(['name'=>'writer']);

        // Permisos generales compartidos admin.
        Permission::create(['name' => 'home'])->syncRoles([$role1, $role2, $role4]);

        // Permisos exclusivos del admin
        Permission::create(['name' => 'users.index'])->syncRoles([$role1]);//,$role0
        Permission::create(['name' => 'users.create'])->syncRoles([$role1]);//,$role0
        Permission::create(['name' => 'users.edit'])->syncRoles([$role1]);//,$role0
        Permission::create(['name' => 'users.delete'])->syncRoles([$role1]);//,$role0

        // Ejemplo de permisos para permissions
        Permission::create(['name' => 'permissions.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'permissions.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'permissions.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'permissions.delete'])->syncRoles([$role1]);

        // Ejemplo de permisos para roles
        Permission::create(['name' => 'roles.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'roles.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'roles.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'roles.delete'])->syncRoles([$role1]);

        // Ejemplo de permisos para artículos
        Permission::create(['name' => 'articulos.index'])->syncRoles([$role1,$role2, $role4]);
        Permission::create(['name' => 'articulos.create'])->syncRoles([$role1,$role2, $role4]);
        Permission::create(['name' => 'articulos.edit'])->syncRoles([$role1,$role2, $role4]);
        Permission::create(['name' => 'articulos.delete'])->syncRoles([$role1,$role2 ]);
    }
}
