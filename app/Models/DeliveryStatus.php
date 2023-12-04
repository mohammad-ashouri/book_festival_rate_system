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
        'description',
        'registrar'
    ];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function postInfo()
    {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }
}
