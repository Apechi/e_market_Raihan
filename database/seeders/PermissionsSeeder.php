<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create default permissions
        Permission::create(['name' => 'list customers']);
        Permission::create(['name' => 'view customers']);
        Permission::create(['name' => 'create customers']);
        Permission::create(['name' => 'update customers']);
        Permission::create(['name' => 'delete customers']);

        Permission::create(['name' => 'list items']);
        Permission::create(['name' => 'view items']);
        Permission::create(['name' => 'create items']);
        Permission::create(['name' => 'update items']);
        Permission::create(['name' => 'delete items']);

        Permission::create(['name' => 'list orders']);
        Permission::create(['name' => 'view orders']);
        Permission::create(['name' => 'create orders']);
        Permission::create(['name' => 'update orders']);
        Permission::create(['name' => 'delete orders']);

        Permission::create(['name' => 'list orderdetails']);
        Permission::create(['name' => 'view orderdetails']);
        Permission::create(['name' => 'create orderdetails']);
        Permission::create(['name' => 'update orderdetails']);
        Permission::create(['name' => 'delete orderdetails']);

        Permission::create(['name' => 'list ordershells']);
        Permission::create(['name' => 'view ordershells']);
        Permission::create(['name' => 'create ordershells']);
        Permission::create(['name' => 'update ordershells']);
        Permission::create(['name' => 'delete ordershells']);

        Permission::create(['name' => 'list products']);
        Permission::create(['name' => 'view products']);
        Permission::create(['name' => 'create products']);
        Permission::create(['name' => 'update products']);
        Permission::create(['name' => 'delete products']);

        Permission::create(['name' => 'list purchases']);
        Permission::create(['name' => 'view purchases']);
        Permission::create(['name' => 'create purchases']);
        Permission::create(['name' => 'update purchases']);
        Permission::create(['name' => 'delete purchases']);

        Permission::create(['name' => 'list purchasedetails']);
        Permission::create(['name' => 'view purchasedetails']);
        Permission::create(['name' => 'create purchasedetails']);
        Permission::create(['name' => 'update purchasedetails']);
        Permission::create(['name' => 'delete purchasedetails']);

        Permission::create(['name' => 'list rombels']);
        Permission::create(['name' => 'view rombels']);
        Permission::create(['name' => 'create rombels']);
        Permission::create(['name' => 'update rombels']);
        Permission::create(['name' => 'delete rombels']);

        Permission::create(['name' => 'list suppliers']);
        Permission::create(['name' => 'view suppliers']);
        Permission::create(['name' => 'create suppliers']);
        Permission::create(['name' => 'update suppliers']);
        Permission::create(['name' => 'delete suppliers']);

        Permission::create(['name' => 'list transactions']);
        Permission::create(['name' => 'view transactions']);
        Permission::create(['name' => 'create transactions']);
        Permission::create(['name' => 'update transactions']);
        Permission::create(['name' => 'delete transactions']);

        Permission::create(['name' => 'list transactiondetails']);
        Permission::create(['name' => 'view transactiondetails']);
        Permission::create(['name' => 'create transactiondetails']);
        Permission::create(['name' => 'update transactiondetails']);
        Permission::create(['name' => 'delete transactiondetails']);

        Permission::create(['name' => 'list transactiontypes']);
        Permission::create(['name' => 'view transactiontypes']);
        Permission::create(['name' => 'create transactiontypes']);
        Permission::create(['name' => 'update transactiontypes']);
        Permission::create(['name' => 'delete transactiontypes']);

        // Create user role and assign existing permissions
        $currentPermissions = Permission::all();
        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo($currentPermissions);

        // Create admin exclusive permissions
        Permission::create(['name' => 'list roles']);
        Permission::create(['name' => 'view roles']);
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'update roles']);
        Permission::create(['name' => 'delete roles']);

        Permission::create(['name' => 'list permissions']);
        Permission::create(['name' => 'view permissions']);
        Permission::create(['name' => 'create permissions']);
        Permission::create(['name' => 'update permissions']);
        Permission::create(['name' => 'delete permissions']);

        Permission::create(['name' => 'list users']);
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);

        // Create admin role and assign all permissions
        $allPermissions = Permission::all();
        $adminRole = Role::create(['name' => 'super-admin']);
        $adminRole->givePermissionTo($allPermissions);

        $user = \App\Models\User::whereEmail('admin@admin.com')->first();

        if ($user) {
            $user->assignRole($adminRole);
        }
    }
}
