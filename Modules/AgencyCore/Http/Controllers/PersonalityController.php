<?php

namespace Modules\AgencyCore\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\AgencyCore\Entities\Personality;

class PersonalityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        return response()->json(Personality::all());
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     */
    public function store(Request $request) {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     */
    public function show($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int     $id
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     */
    public function destroy($id) {
        //
    }
}
