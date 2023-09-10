<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Report;

class ReportsController extends Controller
{
    function __construct() {
        $this->report = new Report;
    }

    public function accomplishments_reports(Request $request) {

        $reports = Report::with('user:id,name');

        return view('partials.reports.monthly-report.show', compact('reports'));
    }
}
