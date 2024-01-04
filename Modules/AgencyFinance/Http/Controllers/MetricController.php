<?php

namespace Modules\AgencyFinance\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\AgencyFinance\Entities\Payment;

class MetricController extends Controller
{
    public function currentMonthTotalPayment() {
        return Payment::where('type',
                              '<>',
                              'credit-note')
                      ->whereBetween('created_at',
                                     [now()->startOfMonth(), now()->endOfMonth()])
                      ->sum('amount');
    }

    public function currentMonthTotalPaymentDataset() {
        $months = [];
        $dataPoints = [];
        $refDate = now();

        for($i = 0; $i < 5; $i++) {
            $months = array_merge($months,
                                  [$refDate->format('M')]);

            $startDate = $refDate->clone()->startOfMonth();
            $endDate = $refDate->clone()->endOfMonth();

            $amount = Payment::where('type',
                                     '<>',
                                     'credit-note')
                             ->whereBetween('created_at',
                                            [$startDate, $endDate])
                             ->sum('amount');

            $dataPoints = array_merge($dataPoints,
                                      [$amount]);

            $refDate = $refDate->addMonths(-1);
        }

        return [
            'months'      => array_reverse($months),
            'data_points' => array_reverse($dataPoints),
        ];
    }
}
