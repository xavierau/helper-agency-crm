<?php

use App\Permission;
use App\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        $adminRole = Role::create([
                                      'label' => 'Administrator',
                                      'name'  => 'administrator',
                                  ]);

        Permission::all()->each(fn(Permission $p) => $adminRole->givePermissionTo($p->name));
    }
}
