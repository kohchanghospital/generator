<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\InspectionNumber;
use Carbon\Carbon;


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

            DB::transaction(function () use ($inspection) {

                $year = now()->year;

                $lastNo = InspectionNumber::whereYear('created_at', $year)
                    ->lockForUpdate()
                    ->orderByDesc('id')
                    ->value('inspection_no');

                $running = 1;
                if ($lastNo) {
                    $running = (int) substr($lastNo, -4) + 1;
                }

                $inspectionNo = 'INS-' . $year . '-' . str_pad($running, 4, '0', STR_PAD_LEFT);

                // set ให้ inspections
                $inspection->inspection_no = $inspectionNo;

                // เก็บประวัติเลข (ไม่สนว่ามีใครลบ inspection)
                InspectionNumber::create([
                    'inspection_no' => $inspectionNo,
                ]);
            });
        });
    }


    public function checklistResults()
    {
        return $this->hasMany(InspectionChecklist::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function generator()
    {
        return $this->belongsTo(Generator::class);
    }

    public function getInspectionDateFormattedAttribute()
    {
        return Carbon::parse($this->inspection_date)->format('d/m/Y');
    }

    public function getInspectionTimeFormattedAttribute()
    {
        return Carbon::parse($this->inspection_time)->format('H:i');
    }
}
