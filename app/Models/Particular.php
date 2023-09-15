<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\SummaryReport;

class Particular extends Model
{
    use HasFactory;

    protected $fillable = [
        'particular_description',
    ];

    public function actualreports()
    {
        return $this->hasMany(SummaryReport::class);
    }

    public function getParticularList() {
        return $this->all();
    }
}
