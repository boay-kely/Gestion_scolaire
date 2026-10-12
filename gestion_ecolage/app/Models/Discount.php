<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'fee_type_id',
        'percentage',
        'reason',
        'valid_from',
        'valid_to',
    ];

    protected $dates = ['valid_from', 'valid_to'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function feeType()
    {
        return $this->belongsTo(FeeType::class);
    }

    public function scopeActive($query)
    {
        return $query->where('valid_from', '<=', now())
                     ->where(function ($query) {
                         $query->whereNull('valid_to')
                               ->orWhere('valid_to', '>=', now());
                     });
    }
}
