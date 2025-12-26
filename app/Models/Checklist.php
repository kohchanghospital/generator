<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{
    protected $fillable = [
        'checklist_name',
        'status'
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
