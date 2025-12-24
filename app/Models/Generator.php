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
        'status'
    ];
}