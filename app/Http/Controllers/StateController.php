<?php

namespace App\Http\Controllers;

use App\Models\State;
use Illuminate\Http\Request;

class StateController extends Controller
{
    public function getStatesByCountry(Request $request)
    {
        $states = State::where('country_id', $request->country_id)->get();

        return $states;
    }
}
