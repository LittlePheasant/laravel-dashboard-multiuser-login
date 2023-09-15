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

    protected $fillable = [
        'quarter_id',
        'particular_id',
        'user_id',
        'count',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getSummaryReportList() {
        return $this->all();
    }

    public function particular()
    {
        return $this->belongsTo(Particular::class, 'particular_id');
    }

    public function quarter()
    {
        return $this->belongsTo(Quarter::class, 'quarter_id');
    }

}
