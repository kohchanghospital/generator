<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeneratorChecklist extends Model
{
    protected $fillable = [
        'electrical_number',
        'check_date',
        'check_time',
        'created_by',
        'remark'
    ];
}
