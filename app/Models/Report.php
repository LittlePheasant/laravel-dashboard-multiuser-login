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
        'user_id',
        'program_id',
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
        'role',
        'cost_fund',
        'filename',
        
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getAccReportList() {
        return $this->all();
    }

    public function program()
    {
        return $this->belongsTo(Program::class, 'id');
    }
}
