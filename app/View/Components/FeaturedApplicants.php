<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Modules\AgencyCore\Entities\Applicant;

class FeaturedApplicants extends Component
{

    public $applicants;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($number = 8) {
        $this->applicants = Applicant::featured()->take($number)->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render() {
        return view('components.featured-applicants',
                    ['applicants' => $this->applicants]);
    }
}
