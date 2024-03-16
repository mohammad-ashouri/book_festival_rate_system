<?php

namespace App\Models;

use App\Models\Catalogs\Language;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GeneralInformation extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'general_informations';
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'national_code',
        'mobile',
        'howzah_code',
        'gender'
    ];
    public function userInfo()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
