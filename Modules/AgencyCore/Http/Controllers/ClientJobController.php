<?php
/**
 * Author: A & A Creation Co.
 * Date: 21/9/2020
 * Time: 9:52 PM
 */

namespace Modules\AgencyCore\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\AgencyCore\Actions\CreateClientJob;
use Modules\AgencyCore\DataTransferObject\JobData;
use Modules\AgencyCore\Entities\Client;
use Modules\AgencyCore\Http\Requests\ClientJobStoreRequest;
use Modules\AgencyCore\Transformers\JobResource;

class ClientJobController extends Controller
{

    public function store(Client $client, ClientJobStoreRequest $request, CreateClientJob $action
    ): JobResource {
        $this->authorize('agency-core:job.create');

        $job = $action->execute($client,
                                JobData::fromFormData($request->validated()));

        return new JobResource($job);

    }
}
