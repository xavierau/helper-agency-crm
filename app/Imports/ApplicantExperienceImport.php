<?php

namespace App\Imports;

use Carbon\Carbon;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Modules\AgencyCore\Actions\CreateNewApplicantExperience;
use Modules\AgencyCore\DataTransferObject\ApplicantExperienceDTO;
use Modules\AgencyCore\Entities\Applicant;
use Modules\AgencyCore\Entities\ApplicantExperience;
use Modules\AgencyCore\Entities\DomesticDuty;

class ApplicantExperienceImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {

        $applicant = $this->getApplicant($row['hk_code']);

        if ($applicant === null) {
            return;
        }

        $duties = $this->getDomesticDuties($row['duties']);

        [$start_date, $end_date] = explode('-', $row['period']);

        $action = new CreateNewApplicantExperience();

        $validatedData = [
            "duties"   => $duties->pluck('id')->toArray(),
            "from"     => Carbon::createFromFormat('Y', trim($start_date)),
            "location" => ucwords( Str::lower($row['country'])),
            "status"   => Str::lower($row['contract_status']),
            "to"       => Carbon::createFromFormat('Y', trim($end_date)),
            "reason"   => $row['reason'] === "No" ? null : ucwords($row['reason'])
        ];
        $data = ApplicantExperienceDTO::FromFormData($validatedData);

        $action->execute($applicant, $data);


    }

    private function getApplicant(string $hk_code): Applicant|null
    {
        return Applicant::where('hk_code', $hk_code)->first();
    }

    private function getDomesticDuties(mixed $duties)
    {
        $mapping = [
            "ELDERLY"     => "Care of elderly",
            "DISABLE"     => "Care of disabled",
            "BEDRIDDEN"   => "Care of bedridden",
            "BABY"        => "Care of baby",
            "CHILDRED"    => "Care of child",
            "PET"         => "Care of pet",
            "HOUSEHOLD"   => "Household work",
            "CAR WASHING" => "Car washing",
            "DRIVING"     => "Driving",
            "GARDENING"   => "Gardening",
        ];
        $duties = explode(',', $duties);

        $duties = collect($duties)
            ->map(fn($d) => $mapping[trim($d)] ?? null)
            ->reject(null);

        return DomesticDuty::whereIn('label', $duties)->get();

    }
}
