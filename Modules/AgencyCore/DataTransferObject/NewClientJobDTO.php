<?php
/**
 * Author: A & A Creation Co.
 * Date: 21/9/2020
 * Time: 9:56 PM
 */

namespace Modules\AgencyCore\DataTransferObject;


use Modules\AgencyCore\Http\Requests\ClientJobStoreRequest;

class NewClientJobDTO
{
    private array $jobData;

    /**
     * NewClientJobDTO constructor.
     * @param \Modules\AgencyCore\Http\Requests\ClientJobStoreRequest $request
     */
    public function __construct(ClientJobStoreRequest $request) {
        $this->jobData = $request->validated();
    }


    /**
     * @return array
     */
    public function getJobData(): array {
        if($this->jobData['service_type'] === 'people') {
            $data = $this->jobData['people'];
        } else {
            $data['services'] = $this->jobData['other']['services'];
            $data['note'] = $this->jobData['other']['note'];
        }

        $data['service_type'] = $this->jobData['service_type'];

        return $data;
    }
}
