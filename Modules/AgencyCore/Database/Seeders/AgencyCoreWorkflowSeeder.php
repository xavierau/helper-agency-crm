<?php

namespace Modules\AgencyCore\Database\Seeders;

use Anacreation\Workflow\Entities\Workflow;
use Anacreation\Workflow\Services\WorkflowRegistry;
use Illuminate\Database\Seeder;
use Modules\AgencyContract\Entities\Contract;

class AgencyCoreWorkflowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->createWorkflow();
    }

    public function createWorkflow()
    {
        $workflows = [
            [
                'label'       => 'Contract Workflow',
                'code'        => 'contract',
                'entity'      => Contract::class,
                'states'      => [
                    [
                        'label'      => 'Pending',
                        'code'       => 'pending',
                        'is_initial' => true,
                    ],
                    [
                        'label'      => 'Submitted',
                        'code'       => 'submitted',
                        'is_initial' => false,
                    ],
                    [
                        'label'      => 'Confirmed',
                        'code'       => 'confirmed',
                        'is_initial' => false,
                    ],
                    [
                        'label'      => 'Active',
                        'code'       => 'active',
                        'is_initial' => false,
                    ],
                    [
                        'label'      => 'Expired',
                        'code'       => 'expired',
                        'is_initial' => false,
                    ],
                    [
                        'label'      => 'Terminated',
                        'code'       => 'terminated',
                        'is_initial' => false,
                    ],
                    [
                        'label'      => 'Cancelled',
                        'code'       => 'cancelled',
                        'is_initial' => false,
                    ],

                ],
                'transitions' => [
                    [
                        'label'      => 'Submit',
                        'code'       => 'submit',
                        'from_state' => 'pending',
                        'to_state'   => 'submitted',
                    ],
                    [
                        'label'      => 'Cancel',
                        'code'       => 'cancel_from_pending',
                        'from_state' => 'pending',
                        'to_state'   => 'cancelled',
                    ],
                    [
                        'label'      => 'Confirm',
                        'code'       => 'confirm',
                        'from_state' => 'submitted',
                        'to_state'   => 'confirmed',
                    ],
                    [
                        'label'      => 'Cancel',
                        'code'       => 'cancel_from_submitted',
                        'from_state' => 'submitted',
                        'to_state'   => 'cancelled',
                    ],
                    [
                        'label'      => 'Activate',
                        'code'       => 'activate',
                        'from_state' => 'confirmed',
                        'to_state'   => 'active',
                    ],
                    [
                        'label'      => 'Cancel',
                        'code'       => 'cancel_from_confirmed',
                        'from_state' => 'confirmed',
                        'to_state'   => 'cancelled',
                    ],

                    [
                        'label'      => 'Expire',
                        'code'       => 'expire',
                        'from_state' => 'active',
                        'to_state'   => 'expired',
                    ],
                    [
                        'label'      => 'Terminated',
                        'code'       => 'terminate',
                        'from_state' => 'active',
                        'to_state'   => 'terminated',
                    ],
                ],
            ],
        ];

        foreach ($workflows as $workflow) {

            $wf = Workflow::create([
                'label' => $workflow['label'],
                'code'  => $workflow['code'],
            ]);

            WorkflowRegistry::register($workflow['entity'],
                $wf);

            foreach ($workflow['states'] as $state) {
                $wf->states()->create([
                    'label'      => $state['label'],
                    'code'       => $state['code'],
                    'is_initial' => $state['is_initial'],
                ]);
            }

            foreach ($workflow['transitions'] as $transition) {
                $wf->transitions()->create([
                    'label'         => $transition['label'],
                    'code'          => $transition['code'],
                    'from_state_id' => $wf->states()->where('code',
                        $transition['from_state'])
                        ->firstOrFail()->id,
                    'to_state_id'   => $wf->states()->where('code',
                        $transition['to_state'])
                        ->firstOrFail()->id,
                ]);
            }

        }

    }
}
