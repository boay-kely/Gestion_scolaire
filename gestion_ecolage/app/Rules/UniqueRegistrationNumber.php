<?php

namespace App\Rules;

use App\Models\Student;
use Illuminate\Contracts\Validation\Rule;

class UniqueRegistrationNumber implements Rule
{
    private $excludeId;
    private $existingStudent;

    public function __construct($excludeId = null)
    {
        $this->excludeId = $excludeId;
    }

    public function passes($attribute, $value)
    {
        $query = Student::where('registration_number', $value);

        // Debug: Log the exclude ID
        if ($this->excludeId) {
            $query->where('id', '!=', $this->excludeId);
        }

        // Store the existing student if found
        $this->existingStudent = $query->first();
        
        // Return false if a different student has this registration number
        return !$this->existingStudent;
    }

    public function message()
    {
        if ($this->existingStudent) {
            $fullName = trim($this->existingStudent->first_name . ' ' . $this->existingStudent->last_name);
            return "Ce matricule appartient déjà à l'étudiant : <strong>{$fullName}</strong>";
        }
        return 'Le matricule :input existe déjà. Veuillez en saisir un unique.';
    }
}
