<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeliveryStatus extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'delivery_statuses';
    protected $fillable = [
        'post_id',
        'rater_id',
        'registrar'
    ];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function postInfo()
    {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }
    public function raterInfo()
    {
        return $this->belongsTo(User::class, 'rater_id', 'id');
    }
    public function registrarInfo()
    {
        return $this->belongsTo(User::class, 'registrar', 'id');
    }
}
