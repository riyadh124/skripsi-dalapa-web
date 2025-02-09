<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListMaterial extends Model
{
    use HasFactory;
   
    protected $fillable = [
        'workorder_id',
        'material_id',
        'count',
    ];

    public function workorder()
    {
        return $this->belongsTo(Workorder::class);
    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}
