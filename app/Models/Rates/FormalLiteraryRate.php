<?php

namespace App\Models\Rates;

use App\Models\RateInfo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormalLiteraryRate extends Model
{
    use HasFactory,SoftDeletes;
    protected $table='formal_literary_rates';
    protected $fillable=[
        'rate_info_id',
        'points_info',
        'sum',
        'rater',
        'editor',
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
