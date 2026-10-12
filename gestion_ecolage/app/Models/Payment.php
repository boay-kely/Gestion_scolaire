<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'fee_type_id',
        'amount',
        'payment_mode',
        'reference',
        'processed_by',
        'academic_year_id',
        'notes',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function feeType()
    {
        return $this->belongsTo(FeeType::class);
    }

    public function processedBy()
    {
        return $this->belongsTo(User::class, 'processed_by');
    }

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function receipt()
    {
        return $this->hasOne(Receipt::class);
    }
}
