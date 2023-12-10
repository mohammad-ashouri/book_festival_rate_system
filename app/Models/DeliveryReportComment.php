<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeliveryReportComment extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'delivery_report_comments';
    protected $fillable = [
        'status_id',
        'description',
        'registrar',
        'jalali_date',
    ];
    protected $hidden = [ 'updated_at', 'deleted_at'];

    public function statusInfo()
    {
        return $this->belongsTo(DeliveryStatus::class, 'status_id', 'id');
    }
    public function registrarInfo()
    {
        return $this->belongsTo(User::class, 'registrar', 'id');
    }
}
