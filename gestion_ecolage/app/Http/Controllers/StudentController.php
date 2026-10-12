<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Classroom;
use App\Models\ParentGuardian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::with(['classroom.level', 'parentGuardian', 'createdBy']);
        
        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('registration_number', 'like', "%{$search}%")
                  ->orWhereHas('classroom', function($subq) use ($search) {
                      $subq->where('name', 'like', "%{$search}%");
                  });
            });
        }
        
        // Sort by registration_number in ascending order
        $students = $query->orderBy('registration_number', 'asc')->paginate(7);
        return view('students.index', compact('students'));
    }

    public function create()
    {
        $classrooms = Classroom::with('level')->get();
        $parents = ParentGuardian::orderBy('first_name')->get();
        
        // Generate next registration number (auto-incremented)
        $lastStudent = Student::orderByDesc('registration_number')->first();
        $nextRegistrationNumber = $lastStudent ? (int)$lastStudent->registration_number + 1 : 1001;
        
        return view('students.create', compact('classrooms', 'parents', 'nextRegistrationNumber'));
    }

    public function store(Request $request)
    {
        // Generate next registration number if not provided or empty
        $registrationNumber = $request->registration_number ?: null;
        
        if (!$registrationNumber) {
            $lastStudent = Student::orderByDesc('registration_number')->first();
            $registrationNumber = $lastStudent ? (int)$lastStudent->registration_number + 1 : 1001;
        }
        
        // Convert registration_number to string to ensure consistency
        $requestRegNum = (string) $registrationNumber;

        // Custom validation for registration_number
        $existingStudent = Student::where('registration_number', $requestRegNum)->first();
        if ($existingStudent) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['registration_number' => "Ce matricule appartient déjà à l'étudiant : <strong>{$existingStudent->full_name}</strong>"]);
        }

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|in:M,F',
            'birth_date' => 'required|date_format:Y-m-d|before:today',
            'birth_place' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'classroom_id' => 'required|exists:classrooms,id',
            'parent_guardian_id' => 'nullable|exists:parents,id',
        ]);

        $validated['registration_number'] = $requestRegNum;
        $validated['created_by'] = auth()->id();

        if ($request->hasFile('photo')) {
            try {
                $file = $request->file('photo');
                // Store the file and get the path
                $path = $file->store('students', 'public');
                $validated['photo'] = $path;
                
                // Ensure the file is readable
                @chmod(storage_path('app/public/' . $path), 0644);
            } catch (\Exception $e) {
                // Log the error but continue without photo
                Log::error('Photo upload failed: ' . $e->getMessage());
            }
        }

        Student::create($validated);

        return redirect()->route('students.index')->with('success', 'Étudiant créé avec succès.');
    }

    public function show(Student $student)
    {
        $student->load(['classroom.level', 'parentGuardian', 'createdBy', 'payments.feeType', 'discounts']);
        return view('students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        $classrooms = Classroom::with('level')->get();
        $parents = ParentGuardian::orderBy('first_name')->get();
        return view('students.edit', compact('student', 'classrooms', 'parents'));
    }

    public function update(Request $request, Student $student)
    {
        // Convert registration_number to string to ensure consistency
        $requestRegNum = (string) $request->registration_number;
        $currentRegNum = (string) $student->registration_number;

        // Custom validation for registration_number (exclude current student)
        if ($requestRegNum !== $currentRegNum) {
            $existingStudent = Student::where('registration_number', $requestRegNum)->first();
            if ($existingStudent) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['registration_number' => "Ce matricule appartient déjà à l'étudiant : <strong>{$existingStudent->full_name}</strong>"]);
            }
        }

        $validated = $request->validate([
            'registration_number' => 'required|string',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|in:M,F',
            'birth_date' => 'required|date_format:Y-m-d|before:today',
            'birth_place' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'classroom_id' => 'required|exists:classrooms,id',
            'parent_guardian_id' => 'nullable|exists:parents,id',
        ]);

        if ($request->hasFile('photo')) {
            try {
                $file = $request->file('photo');
                // Store the file and get the path
                $path = $file->store('students', 'public');
                $validated['photo'] = $path;
                
                // Ensure the file is readable
                @chmod(storage_path('app/public/' . $path), 0644);
            } catch (\Exception $e) {
                // Log the error but continue without updating photo
                Log::error('Photo upload failed: ' . $e->getMessage());
            }
        }

        try {
            $student->update($validated);
        } catch (\Illuminate\Database\QueryException $e) {
            // Handle duplicate registration_number error
            if (strpos($e->getMessage(), '1062') !== false || strpos($e->getMessage(), 'registration_number') !== false) {
                $duplicateStudent = Student::where('registration_number', $validated['registration_number'])
                    ->where('id', '!=', $student->id)
                    ->first();
                
                $errorMsg = $duplicateStudent 
                    ? "Ce matricule appartient déjà à l'étudiant : <strong>{$duplicateStudent->full_name}</strong>"
                    : "Ce matricule est déjà utilisé par un autre étudiant.";
                
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['registration_number' => $errorMsg]);
            }
            throw $e;
        }

        return redirect()->route('students.show', $student)->with('success', 'Étudiant mis à jour avec succès.');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Étudiant supprimé.');
    }
}
