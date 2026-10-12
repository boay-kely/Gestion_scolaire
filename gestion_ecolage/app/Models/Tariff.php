<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tariff extends Model
{
    use HasFactory;

    protected $fillable = [
        'fee_type_id',
        'level_id',
        'academic_year_id',
        'amount',
        'cycle',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    public function feeType()
    {
        return $this->belongsTo(FeeType::class);
    }

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function scopeByCycle($query, $cycle)
    {
        return $query->where('cycle', $cycle);
    }
}
