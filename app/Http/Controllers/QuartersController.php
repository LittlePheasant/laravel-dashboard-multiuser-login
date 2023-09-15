<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Quarter;
use Illuminate\Support\Facades\Validator;

class QuartersController extends Controller
{
    function __construct() {
        $this->quarter = new Quarter;
    }

    public function quarter_list() {
        $quarters = $this->quarter->getQuarterList();

        return view('partials.quarters.show', compact('quarters'));
    }

    public function add_quarter(Request $request) {

        Validator::make($request->all(), [
            'duration_period' => ['required'],
        ]);

        $quarterData = [
            'duration_period' => $request->duration_period
        ];

        Quarter::create($quarterData);

        return redirect()->route('quarters-list');
    }
}
