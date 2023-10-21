<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RateInfo extends Model
{
    use HasFactory;
    protected $table='rate_infos';
    protected $hidden=['created_at','updated_at','deleted_at'];
    protected $fillable=[
        'post_id',
        'rate_status',

        's1g1rater',
        's1g1_status',

        's2g1rater',
        's2g1_status',

        's3g1rater',
        's3g1_status',

        's1g2rater',
        's1g2_status',

        's2g2rater',
        's2g2_status',

        's3g2rater',
        's3g2_status',

        'd1rater',
        'd1_status',

        'd2rater',
        'd2_status',

        'formal_literary_rater',
        'formal_literary_rate_status',

        'd3rater',
        'd3_status',

        'avg_sg1',
        'avg_sg2',
        'grade',

        'chosen_status',
    ];
    public function postInfo()
    {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }

}
