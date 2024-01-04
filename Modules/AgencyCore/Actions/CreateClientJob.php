<?php
/**
 * Author: A & A Creation Co.
 * Date: 21/9/2020
 * Time: 9:55 PM
 */

namespace Modules\AgencyCore\Actions;


use Illuminate\Support\Facades\DB;
use Modules\AgencyCore\DataTransferObject\JobData;
use Modules\AgencyCore\Entities\Client;
use Modules\AgencyCore\Entities\Job;

class CreateClientJob
{


    /**
     * CreateClientJob constructor.
     * @param $createRequirementJob
     */
    public function __construct(
        private CreateRequirement $createRequirementAction)
    {
    }


    /**
     * @param \Modules\AgencyCore\Entities\Client $client
     * @param \Modules\AgencyCore\DataTransferObject\JobData $dto
     * @return \Modules\AgencyCore\Entities\Job
     */
    public function execute(Client $client, JobData $dto): Job
    {
        DB::beginTransaction();

        try {
            $data = $dto->getJobData();

            /** @var \Modules\AgencyCore\Entities\Job $job */
            $job = $client->myJobs()->create($data);

            $this->createRequirementAction->execute($job,
                $dto->getRequirement());

            DB::commit();

            return $job;

        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

    }
}
