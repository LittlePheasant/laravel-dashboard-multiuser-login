<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Particular;

class ParticularsController extends Controller
{

    function __construct() {
        $this->particular = new Particular;
    }

    public function particular_list() {
        $particulars = $this->particular->getParticularList();

        return view('partials.particulars.show', compact('particulars'));
    }

    public function add_particular(Request $request) {

        Validator::make($request->all(), [
            'particular_description' => ['required'],
        ]);

        $particularData = [
            'particular_description' => $request->particular_description
        ];

        Particular::create($particularData);

        return redirect()->route('particulars-list');
    }
}
