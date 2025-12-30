<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InspectionNumber extends Model
{
    protected $fillable = [
        'inspection_no',
        'inspection_id',
        'status',
    ];
}
