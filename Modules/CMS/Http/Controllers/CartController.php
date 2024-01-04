<?php

namespace Modules\CMS\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\AgencyCore\Entities\Applicant;

class CartController extends Controller
{
    public function addToCart(Applicant $applicant)
    {

        $cart = session()->get('cart');

        // if cart is empty then this the first product
        if (!$cart) {

            $cart = [
                $applicant->hk_code => [
                    "id" => $applicant->id,
                    "hk_code" => $applicant->hk_code,
                ]
            ];

            session()->put('cart', $cart);

            return redirect()->back()->with('success', 'Applicant added successfully!');
        }

        // if cart not empty then check if this product exist then increment quantity
        if (isset($cart[$applicant->hk_code])) {

            return redirect()->back()->with('success', 'Applicant added successfully!');
        }

        $cart[$applicant->hk_code] = [
            "id" => $applicant->id,
            "hk_code" => $applicant->hk_code,
        ];

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Applicant added successfully!');
    }
}
