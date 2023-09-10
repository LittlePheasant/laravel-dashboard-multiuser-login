<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Program;

class ProgramsController extends Controller
{
    function __construct() {
        $this->program = new Program;
    }

    public function program_list(Request $request) {

        $programs = Program::with('user:id, name');

        return view('partials.programs.show', compact('programs'));
    }
}
