<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\SummaryReport;

class Quarter extends Model
{
    use HasFactory;

    protected $fillable = [
        'duration_period'
    ];

    public function summaryreports()
    {
        return $this->hasMany(SummaryReport::class);
    }

    public function getQuarterList() {
        return $this->all();
    }
}
