<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WasteReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'location',
        'latitude',
        'longitude',
        'description',
        'waste_type',
        'severity',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function photos()
    {
        return $this->hasMany(WasteReportPhoto::class);
    }
}
