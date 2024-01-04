<?php

namespace Modules\AgencyTemplate\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class AgencyTemplateDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $templates = [
            [
                'label'     => 'Renew Notice',
                'view_path' => 'renew_notice.blade.php'
            ],
            [
                'label'     => 'Termination Notice',
                'view_path' => 'termination_notice.blade.php'
            ],
            [
                'label'     => 'Job Memo',
                'view_path' => 'job_memo.blade.php'
            ],
            [
                'label'     => 'Agreement',
                'view_path' => 'agreement.blade.php'
            ],
        ];

        collect($templates)->each(function ($template) {
            \Modules\AgencyTemplate\Entities\Template::create($template);
        });
    }
}
