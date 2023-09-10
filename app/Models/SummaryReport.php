<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Particular;
use App\Models\Quarter;

class SummaryReport extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function getSummaryReportList() {
        return $this->all();
    }

    public function particular()
    {
        return $this->belongsTo(Particular::class, 'id');
    }

    public function quarter()
    {
        return $this->belongsTo(Quarter::class, 'id');
    }

}
