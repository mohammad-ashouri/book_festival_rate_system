<?php

namespace App\Models\Rates;

use App\Models\RateInfo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SummaryRates extends Model
{
    use HasFactory,SoftDeletes;
    protected $table='summary_rates';
    protected $hidden=[
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public function rateInfo()
    {
        return $this->belongsTo(RateInfo::class, 'rate_info_id', 'id');
    }
}
