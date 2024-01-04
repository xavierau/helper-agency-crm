<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Modules\AgencyCore\Entities\Applicant;
use Modules\AgencyCore\Entities\ApplicantExperience;
use Modules\AgencyCore\Entities\DomesticDuty;

class SearchApplicantForm extends Component
{
    public $nationalities;
    public $religions;
    public $marital_statuses;
    public $duties;
    public $overseas_countries;


    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->nationalities = Applicant::distinct('nationality')
            ->whereNotNull('nationality')
            ->orderBy('nationality')
            ->pluck('nationality');

        $this->religions = Applicant::distinct('religion')
            ->whereNotNull('religion')
            ->orderBy('religion')
            ->pluck('religion');

        $this->marital_statuses = Applicant::distinct('marital_status')
            ->whereNotNull('marital_status')
            ->orderBy('marital_status')
            ->pluck('marital_status');

        $this->overseas_countries = ApplicantExperience::distinct('location')
            ->where('location', '<>', 'hong kong')
            ->orderBy('location')
            ->pluck('location');

        $this->duties = DomesticDuty::pluck('label');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view(
            'components.search-applicant-form',
            [
                'nationalities'    => $this->nationalities,
                'religions'        => $this->religions,
                'marital_statuses' => $this->marital_statuses,
                'duties'           => $this->duties,
            ]
        );
    }
}
