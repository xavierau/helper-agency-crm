<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Modules\AgencyCore\Entities\Applicant;

class SearchApplicantItem extends Component
{

    public Applicant $applicant;
    public string $class;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    function __construct(Applicant $applicant, string $class)
    {
        $this->applicant = $applicant;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.search-applicant-item', [
            'applicant' => $this->applicant,
            'class' => $this->class,
        ]);
    }
}
