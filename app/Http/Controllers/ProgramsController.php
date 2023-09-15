<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Models\Program;

class ProgramsController extends Controller
{
    function __construct() {
        $this->program = new Program;
    }

    public function program_list() {

        $programs = Program::with('user:id,name')
                    ->join('users', 'programs.user_id', '=', 'users.id')
                    ->get();

        $users = DB::table('users')
                ->pluck('campusname', 'id')
                ->toArray();

        
        return view('partials.programs.show', compact('programs', 'users'));
    }

    public function add_program(Request $request) {

        Validator::make($request->all(), [
            'user_id' => ['required'],
            'program_name' => ['required'],
            'description' => ['required'],
        ]);

        $programData =[
            'user_id' => (int)$request->user_id,
            'program_name' => $request->program_name,
            'description' => $request->description,
        ];

        Program::create($programData);

        return redirect()->route('program-list');
    }
}
