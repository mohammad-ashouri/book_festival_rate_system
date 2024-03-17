<?php

namespace App\Models\Catalogs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Publisher extends Model
{
    use HasFactory,SoftDeletes;
    protected $table='publishers';
    protected $fillable = [
        'name',
        'status',
    ];
    protected $hidden=['created_at','updated_at','deleted_at'];
}
