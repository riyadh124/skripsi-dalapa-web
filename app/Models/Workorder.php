<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workorder extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nomor_tiket',
        'witel',
        'sto',
        'headline',
        'lat',
        'lng',
        'evidence_before',
        'evidence_after',
        'status',
    ];

    public function listMaterials()
    {
        return $this->hasMany(ListMaterial::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'workorder_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function documentationBefore(){
        return $this->hasMany(DocumentationBeforeWork::class);
    }

    public function documentationAfter(){
        return $this->hasMany(DocumentationAfterWork::class);
    }
    
}


