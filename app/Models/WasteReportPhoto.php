<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WasteReportPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'waste_report_id',
        'file_path',
    ];

    public function report()
    {
        return $this->belongsTo(WasteReport::class, 'waste_report_id');
    }
}
