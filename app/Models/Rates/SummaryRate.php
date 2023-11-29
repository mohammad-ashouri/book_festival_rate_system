<?php

namespace App\Models\Rates;

use App\Models\RateInfo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SummaryRate extends Model
{
    use HasFactory,SoftDeletes;
    protected $table='summary_rates';
    protected $fillable=[
        'rate_info_id',
        'r1',
        'r2',
        'r3',
        'r4',
        'sum',
        'special_section',
        'rate_type',
        'rater',
        'rate_type'
    ];
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
