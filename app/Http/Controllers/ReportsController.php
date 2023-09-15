<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Models\Report;
use App\Models\SummaryReport;

class ReportsController extends Controller
{
    function __construct() {
        $this->report = new Report;
    }

    public function accomplishments_reports(Request $request) {

        $reports = Report::with('user:id,name')->get();
        
        $programs = DB::table('programs')
                    ->join('users', 'programs.user_id', '=', 'users.id')
                    ->select('programs.program_name', 'programs.id as program_id', 'users.id as user_id')
                    ->get();

        $programArray = [];

        foreach ($programs as $program) {
            $programArray[$program->program_id] = [
                'program_name' => $program->program_name,
                'user_id' => $program->user_id,
            ];
        }

        $units = [
            'days' => 'Days',
            'hours' => 'Hours',
        ];

        return view('partials.reports.monthly-report.show', compact('reports', 'programArray', 'units'));
    }

    public function add_report(Request $request) {

        Validator::make($request->all(), [ 
            'user_id' => ['required'],
            'program_id' => ['required'],
            'startDate' => ['required'],
            'startDate' => ['required'],
            'endDate' => ['required'],
            'title' => ['required'],
            'type_beneficiary' => ['required'],
            'count_male' => ['required'],
            'count_female' => ['required'],
            'poor_rate' => ['required'],
            'fair_rate' => ['required'],
            'satisfactory_rate' => ['required'],
            'verysatisfactory_rate' => ['required'],
            'excellent_rate' => ['required'],
            'duration' => ['required'],
            'unitOpt' => ['required'],
            'serviceOpt' => ['required'],
            'partners' => ['required'],
            'faculty_staff_involve' => ['required'],
            'role' => ['required'],
            'cost_fund' => ['required'],
            'filename' => ['required'],
        ]);

        $countmale = $request->count_male;
        $countfemale = $request->count_female;
        $poorrate = $request->poor_rate;
        $fairrate = $request->fair_rate;
        $satisfactoryrate = $request->satisfactory_rate;
        $verysatisfactoryrate = $request->verysatisfactory_rate;
        $excellentrate = $request->excellent_rate;
        $unitOpt = $request->unitOpt;
        $duration = $request->duration;
        $result = null;
        $weight = null;

        $total_count_male_female = (int)$countmale + (int)$countfemale;
        $partial_sumRates = (int)$satisfactoryrate + (int)$verysatisfactoryrate + (int)$excellentrate;

        //computation for particular_id 4
        if ($partial_sumRates === $total_count_male_female) {
            $result = 100;
        } else {
            if ($total_count_male_female > 0) {
                $percentage = ($partial_sumRates / $total_count_male_female) * 100;
                $result = round($percentage, 2);
            } else {
                // Handle the case when $total_count_male_female is zero or empty
                $result = 0;
            }
        }

        //computation for particular_id 2
        if ($unitOpt == 'hours') {
            if ($duration === 8) {
                $weight = 1;
            } else {
                $weight = 0.5;
            }
        } else {
            if ($duration === 1) {
                $weight = 1;
            } elseif ($duration === 2) {
                $weight = 1.25;
            } elseif ($duration > 2 && $duration < 5) {
                $weight = 1.5;
            } else {
                $weight = 2;
            }
        }

        $total = $total_count_male_female * $weight;


        $reportData =[
            'user_id' => (int)$request->user_id,
            'program_id' => (int)$request->program_id,
            'dates'=> $request->startDate . '-' . $request->endDate,
            'title'=> $request->title,
            'type_beneficiary'=> $request->type_beneficiary,
            'count_male'=> (int)$countmale,
            'count_female'=> (int)$countfemale,
            'poor_rate'=> (int)$poorrate,
            'fair_rate'=> (int)$fairrate,
            'satisfactory_rate'=> (int)$satisfactoryrate,
            'very_satisfactory_rate'=> (int)$verysatisfactoryrate,
            'excellent_rate'=> (int)$excellentrate,
            'duration'=> (int)$duration,
            'unitOpt'=> $request->unitOpt,
            'total_trainees_by_duration'=> $total,
            'total_rate_by_total_beneficiaries'=> $result,
            'serviceOpt'=> $request->serviceOpt,
            'partners'=> $request->partners,
            'faculty_staff_involve'=> $request->faculty_staff_involve,
            'role'=> $request->role,
            'cost_fund'=> $request->cost_fund,
            'filename'=> $request->filename,
        ];
        
        Report::create($reportData);

        DB::transaction(function () use ($reportData) {
            
            // Split the date range into separate start and end dates
            $dateParts = explode('-', $reportData['dates']);

            $startDate = $dateParts[1];
            $endDate = $dateParts[4];
            
            // Extract the quarter from the date (1, 2, 3, or 4)
            $quarter = ceil($startDate / 3);
                                
            // Calculate the starting and ending months of the selected quarter
            $startMonth = ($quarter - 1) * 3 + 1;
            $endMonth = $quarter * 3;

            $summaryReport = DB::table('summary_reports')
                            ->select('summary_reports.*')
                            ->where('user_id', '=', $reportData['user_id'])
                            ->get();

            $rowCountReports = DB::table('reports')
                        ->where('user_id', '=', $reportData['user_id'])
                        ->count('*');
            
            $sumTrainees = DB::table('reports')
                        ->where('user_id', '=', $reportData['user_id'])
                        ->sum('total_trainees_by_duration');

            $rowCountPrograms = DB::table('programs')
                        ->where('user_id', '=', $reportData['user_id'])
                        ->count('*');
            
            $sumRates = DB::table('reports')
                        ->where('user_id', '=', $reportData['user_id'])
                        ->sum('total_rate_by_total_beneficiaries');     
                        
                        
            $summaryReportArray = [];

            foreach ($summaryReport as $report) {
                $summaryReportArray[] = [
                    'quarter_id' => $report->quarter_id,
                    'particular_id' => $report->particular_id,
                    'user_id' => $report->user_id,
                    'count' => $report->count
                ];
            }

            $count1 = $rowCountReports;
            $count2 = $sumTrainees / $count1;
            $count3 = $rowCountPrograms;
            $count4 = $sumRates / $count1;

            // Initialize an array to store data
            $countData = [];

            // Define the particular IDs and corresponding counts
            $particularCounts = [
                1 => (int)$count1,
                2 => round(floatval($count2), 2),
                3 => (int)$count3,
                4 => round(floatval($count4), 2),
            ];

            foreach ($particularCounts as $particular_id => $count) {
                $data = [
                    'quarter_id' => (int)$quarter,
                    'particular_id' => $particular_id,
                    'user_id' => $reportData['user_id'],
                    'count' => $count,
                ];
            
                // Check if a row with the same quarter, particular, and user ID exists
                $existingRow = SummaryReport::where([
                    'quarter_id' => $data['quarter_id'],
                    'particular_id' => $data['particular_id'],
                    'user_id' => $data['user_id'],
                ])->first();
            
                if ($existingRow) {
                    // If the row exists, update it
                    $existingRow->update(['count' => $data['count']]);
                } else {
                    // If no row exists, create a new one
                    SummaryReport::create($data);
                }
            }
                
        }, 5);
        
        return redirect()->route('accomplishment-report');
    }
}
