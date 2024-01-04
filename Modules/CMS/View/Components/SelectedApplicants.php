<?php

namespace Modules\CMS\View\Components;

use Illuminate\Support\Collection;
use Illuminate\View\Component;
use Modules\AgencyCore\Entities\Applicant;

class SelectedApplicants extends Component
{

    public Collection $selected_applicants;
    public string $class;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    function __construct(string $class = '')
    {

        $this->class = $class;

        $cart = session()->get('cart');

        if (!$cart) {
            $this->selected_applicants = collect([]);
        } else {
            $this->selected_applicants = Applicant::whereIn('hk_code', array_keys($cart))->get();
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('cms::Components.selected_applicants', [
            'selected_applicants' => $this->selected_applicants,
            'class' => $this->class,
        ]);
    }
}
