<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cycle',
        'order',
    ];

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

    public function scopeByCycle($query, $cycle)
    {
        return $query->where('cycle', $cycle);
    }
}
