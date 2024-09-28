<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'workorder_id',
        'status',
        'isi_notifikasi',
    ];

    public function workorder()
{
    return $this->belongsTo(Workorder::class, 'workorder_id');
}
}
