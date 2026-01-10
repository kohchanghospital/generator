<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{
    protected $fillable = [
        'checklist_name',
        'is_active'
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function inspectionChecklists()
    {
        return $this->hasMany(InspectionChecklist::class, 'checklist_id');
    }
}
