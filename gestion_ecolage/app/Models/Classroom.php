<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'level_id',
        'academic_year_id',
        'capacity',
    ];

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function studentCount()
    {
        return $this->students()->count();
    }

    public function getCycleAttribute()
    {
        return $this->level?->cycle;
    }
}
