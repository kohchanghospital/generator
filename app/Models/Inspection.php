<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Inspection extends Model
{
    protected $fillable = [
        'inspection_no',
        'inspection_date',
        'inspection_time',
        'generator_id',
        'user_id',
        'remark'
    ];

    protected static function booted()
    {
        static::creating(function ($inspection) {
            $year = now()->year;

            $last = DB::table('inspections')
                ->whereYear('created_at', $year)
                ->orderByDesc('id')
                ->value('inspection_no');

            $running = 1;

            if ($last) {
                $running = (int) substr($last, -4) + 1;
            }

            $inspection->inspection_no =
                'INS-' . $year . '-' . str_pad($running, 4, '0', STR_PAD_LEFT);
        });
    }
}
