<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model
{
    use HasFactory;

    protected $fillable = [
        'year',
        'label',
        'start_date',
        'end_date',
        'is_active',
    ];

    protected $dates = ['start_date', 'end_date'];

    public function classrooms()
    {
        return $this->hasMany(Classroom::class);
    }

    public function tariffs()
    {
        return $this->hasMany(Tariff::class);
    }

    public function paymentSchedules()
    {
        return $this->hasMany(PaymentSchedule::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
