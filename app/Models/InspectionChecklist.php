<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InspectionChecklist extends Model
{
    protected $table = 'inspection_checklists';

    protected $fillable = [
        'inspection_id',
        'checklist_id',
        'status',
        'remark',
    ];

    public function inspection()
    {
        return $this->belongsTo(Inspection::class, 'inspection_id');
    }

    public function checklist()
    {
        return $this->belongsTo(Checklist::class);
    }
}
