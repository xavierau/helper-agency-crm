<?php

namespace Modules\AgencyCore\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\AgencyContractDate\Database\Seeders\AgencyContractDateDatabaseSeeder;
use Modules\AgencyContractDoc\Database\Seeders\AgencyContractDocDatabaseSeeder;
use NationalitiesTableSeeder;
use UsersTableSeeder;

class AgencyCoreDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->call(SupplierTableSeeder::class);
        $this->call(AgencyContractDateDatabaseSeeder::class);
        $this->call(AgencyContractDocDatabaseSeeder::class);
        $this->call(ContractTypesTableSeeder::class);
        $this->call(OrganizationTableSeeder::class);
        $this->call(AgencyCoreWorkflowSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(NationalitiesTableSeeder::class);
        $this->call(DomesticDutiesTableSeeder::class);
        // $this->call(ApplicantTableSeeder::class);
        // $this->call(ClientsTableSeeder::class);
        // $this->call(ContractsTableSeeder::class);
        $this->call(SellableTableSeeder::class);
        $this->call(VariantTableSeeder::class);
    }
}
