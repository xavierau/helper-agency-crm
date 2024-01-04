<?php

namespace Modules\AgencyFinance\Tests\Unit;

use Modules\AgencyContract\Entities\Contract;
use Tests\TestCase;

class ContractCancelledEventHandlerTest extends TestCase
{
    /**
     * @test
     */
    public function credit_note_creation(): void {

        $contract = Contract::factory()->make();

    }
}
