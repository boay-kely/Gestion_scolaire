<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'registration_number',
        'first_name',
        'last_name',
        'gender',
        'birth_date',
        'birth_place',
        'photo',
        'classroom_id',
        'parent_guardian_id',
        'created_by',
    ];

    protected $dates = ['birth_date', 'deleted_at'];

    // Cast registration_number as string
    protected $casts = [
        'registration_number' => 'string',
        'birth_date' => 'date',
    ];

    // Mutator to ensure registration_number is always a string
    public function setRegistrationNumberAttribute($value)
    {
        $this->attributes['registration_number'] = (string) $value;
    }

    // Relations
    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function parent()
    {
        return $this->belongsTo(ParentGuardian::class, 'parent_guardian_id');
    }

    // Alias pour compatibilité
    public function parentGuardian()
    {
        return $this->parent();
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function discounts()
    {
        return $this->hasMany(Discount::class);
    }

    public function receipts()
    {
        return $this->hasMany(Receipt::class);
    }

    // Accessors
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->whereNull('deleted_at');
    }

    public function scopeByClassroom($query, $classroomId)
    {
        return $query->where('classroom_id', $classroomId);
    }
}
