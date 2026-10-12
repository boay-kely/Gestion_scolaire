<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'level_id',
        'academic_year_id',
        'name',
        'deadline',
        'expected_percentage',
        'description',
    ];

    protected $dates = ['deadline'];

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function isOverdue()
    {
        return $this->deadline < now();
    }
}
