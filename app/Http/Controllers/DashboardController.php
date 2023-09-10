<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Program;
use App\Models\Report;
use App\Models\SummaryReport;

class DashboardController extends Controller
{

    function __construct() {
        $this->user = new User;
        $this->program = new Program;
        $this->report = new Report;
        $this->summary = new SummaryReport;
    }

    public function index() {

        $userLength = count($this->user->getUserLists());
        $programLength = count($this->program->getProgramList());
        $reportLength = count($this->report->getAccReportList());
        $summaryLength = count($this->summary->getSummaryReportList());
        //dd($userLength);
        return view('components.dashboard', compact('userLength', 'programLength', 'reportLength', 'summaryLength'));
    }
}
