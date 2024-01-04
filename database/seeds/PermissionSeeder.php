<?php

use App\Permission;
use App\Role;
use App\Setting;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Modules\AgencyContract\Entities\Contract;
use Modules\AgencyContract\Entities\ContractType;
use Modules\AgencyCore\Entities\Applicant;
use Modules\AgencyCore\Entities\Client;
use Modules\AgencyCore\Entities\Job;
use Modules\AgencyCore\Entities\ServiceAgreement;
use Modules\AgencyCore\Entities\ServiceAgreementType;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $objects = [
            Job::class,
            User::class,
            Role::class,
            Client::class,
            Setting::class,
            Contract::class,
            Applicant::class,
            ContractType::class,
            ServiceAgreement::class,
            ServiceAgreementType::class,
        ];
        $actions = [
            'list',
            'show',
            'create',
            'edit',
            'delete',
        ];

        foreach($objects as $object) {
            foreach($actions as $action) {
                Permission::firstOrCreate([
                                              'name' => getPermissionName($object,
                                                                          $action),
                                          ],
                                          [
                                              'label'  => Str::ucfirst($action),
                                              'object' => $object,
                                              'action' => $action,
                                          ]);
            }
        }

    }
}
