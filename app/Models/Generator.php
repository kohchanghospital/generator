<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Generator extends Model
{
    protected $fillable = [
        'machine_code',
        'asset_no',
        'asset_name',
        'brand',
        'detail',
        'is_active'
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function inspections()
    {
        return $this->hasMany(Inspection::class);
    }
}
