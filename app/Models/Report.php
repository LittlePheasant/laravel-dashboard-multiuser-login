<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Program;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'dates',
        'title',
        'type_beneficiary',
        'count_male',
        'count_female',
        'poor_rate',
        'fair_rate',
        'satisfactory_rate',
        'very_satisfactory_rate',
        'excellent_rate',
        'duration',
        'unitOpt',
        'total_trainees_by_duration',
        'total_rate_by_total_beneficiaries',
        'serviceOpt',
        'partners',
        'faculty_staff_involve',
        'cost_fund',
        'filename',
        
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function getAccReportList() {
        return $this->all();
    }

    public function program()
    {
        return $this->belongsTo(Program::class, 'id');
    }
}
