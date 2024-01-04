<?php

use Illuminate\Database\Seeder;
use Modules\AgencyCore\Database\Seeders\AgencyCoreDatabaseSeeder;
use Modules\AgencyCore\Database\Seeders\OrganizationTableSeeder;
use Modules\AgencyTemplate\Database\Seeders\AgencyTemplateDatabaseSeeder;
use Modules\CMS\Database\Seeders\CMSDatabaseSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(SettingSeeder::class);
        $this->call(OrganizationTableSeeder::class);
        $this->call(UsersTableSeeder::class);
//        $this->call(AgencyCoreDatabaseSeeder::class);
        $this->call(CMSDatabaseSeeder::class);
        $this->call(AgencyTemplateDatabaseSeeder::class);
    }
}
