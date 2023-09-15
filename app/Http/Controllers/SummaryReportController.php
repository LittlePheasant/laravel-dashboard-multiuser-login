<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\SummaryReport;

class SummaryReportController extends Controller
{
    
    function __construct() {
        $this->actualreport = new SummaryReport;
    }

    public function actual_reports() {

        $actualReports = SummaryReport::with('particular:id,particular_description', 'quarter:id,duration_period', 'user:id,name')
                        ->join('particulars', 'summary_reports.particular_id', '=', 'particulars.id') // Join with the particulars table
                        ->join('quarters', 'summary_reports.quarter_id', '=', 'quarters.id') // Join with the quarters table
                        ->orderBy('particulars.id') // Order by the id field of the particulars table
                        ->orderBy('quarters.id')
                        ->get();
        
        $reports = [];

        $actualReports->each(function($item) use (&$reports) {
            $particular_id = $item->particular->particular_description;
            $quarter_id = $item->quarter_id;
            $user_name = $item->user->name;
            //$category = $item->particular->particular_description;
            $count = $item->count;

            if (!isset($reports[$particular_id])) {
                $reports[$particular_id] = [];
            }
        
            if (!isset($reports[$particular_id][$quarter_id])) {
                $reports[$particular_id][$quarter_id] = [];
            }
                        
            // Store the count value in the reports array
            $reports[$particular_id][$quarter_id][$user_name] = [
                'count' => $count
            ];
        });

        //dd($reports);
        
        return view('partials.reports.summary-report.show', compact('reports'));
    }
}
// Find the corresponding count value for this particular and quarter
            // $count = SummaryReport::where('particular_id', $particular_id)
            //                 ->where('quarter_id', $quarter_id)
            //                 ->where('user_id', $user_id)
            //                 ->first()
            //                 ->count;