<?php

namespace App\Models\Catalogs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DefencePlace extends Model
{
    use HasFactory;
    protected $table='defence_places';
    protected $fillable = [
        'name',
        'status',
    ];
    protected $hidden=['created_at','updated_at','deleted_at'];
}
