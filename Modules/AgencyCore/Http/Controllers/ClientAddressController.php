<?php

namespace Modules\AgencyCore\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\AgencyCore\Entities\Address;
use Modules\AgencyCore\Entities\Client;

class ClientAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param \Modules\AgencyCore\Entities\Client $client
     * @return Renderable
     */
    public function index(Client $client) {
        return response()->json($client->addresses);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create() {
        return view('agencycore::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request) {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id) {
        return view('agencycore::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id) {
        return view('agencycore::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int     $id
     * @return Renderable
     */
    public function update(Request $request, Client $client, Address $address) {
        $validatedData = $this->validate($request,
                                         [
                                             'address_1' => ['nullable'],
                                             'address_2' => ['nullable'],
                                             'address_3' => ['nullable'],
                                         ]);
        $address->update($validatedData);


        return response(204);

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id) {
        //
    }
}
