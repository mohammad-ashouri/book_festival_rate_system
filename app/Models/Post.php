<?php

namespace App\Models;

use App\Models\Catalogs\Festival;
use App\Models\Catalogs\Language;
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
    public function festivalInfo()
    {
        return $this->belongsTo(Festival::class, 'festival_id', 'id');
    }
    public function languageInfo()
    {
        return $this->belongsTo(Language::class, 'language', 'id');
    }
    public function scientificGroup1Info()
    {
        return $this->belongsTo(ScientificGroup::class, 'scientific_group_v1', 'id');
    }
    public function scientificGroup2Info()
    {
        return $this->belongsTo(ScientificGroup::class, 'scientific_group_v2', 'id');
    }
    public function sorterInfo()
    {
        return $this->belongsTo(User::class, 'sorter', 'id');
    }
}
