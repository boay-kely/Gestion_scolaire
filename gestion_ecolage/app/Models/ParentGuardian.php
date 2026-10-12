<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentGuardian extends Model
{
    use HasFactory;

    protected $table = 'parents';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'phone_secondary',
        'address',
        'occupation',
        'relationship',
        'annual_income',
        'notes',
    ];

    protected $casts = [
        'annual_income' => 'decimal:2',
    ];

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
