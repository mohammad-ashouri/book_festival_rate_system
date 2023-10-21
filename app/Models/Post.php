<?php

namespace App\Models;

use App\Models\Catalogs\ScientificGroup;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory,SoftDeletes;
    protected $table='posts';
    protected $hidden=['created_at','updated_at','deleted_at'];
    public function personInfo()
    {
        return $this->belongsTo(Person::class, 'person_id', 'id');
    }
}
