<?php

namespace Modules\AgencyContract\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\AgencyContract\Entities\Contract;

class MetricController extends Controller
{
    public function currentMonthTotalNew() {
        return Contract::whereBetween('created_at',
                                      [now()->startOfMonth(), now()->endOfMonth()])
                       ->count();
    }
}
