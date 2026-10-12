<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\Level;
use App\Models\Classroom;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    public function index(Request $request)
    {
        $query = Classroom::with(['level', 'academicYear']);
        
        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhereHas('level', function($subq) use ($search) {
                      $subq->where('name', 'like', "%{$search}%");
                  })
                  ->orWhereHas('academicYear', function($subq) use ($search) {
                      $subq->where('label', 'like', "%{$search}%");
                  });
            });
        }
        
        $classrooms = $query->paginate(7);
        return view('classrooms.index', compact('classrooms'));
    }

    public function create()
    {
        $academicYears = AcademicYear::all();
        return view('classrooms.create', compact('academicYears'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'level_name' => 'required|string|max:50',
            'academic_year_id' => 'required|exists:academic_years,id',
            'capacity' => 'required|integer|min:1|max:100',
        ]);

        // Create or get the level
        $level = Level::firstOrCreate(
            ['name' => $validated['level_name']],
            ['cycle' => 'primaire'] // Default cycle
        );

        $classroomData = [
            'name' => $validated['name'],
            'level_id' => $level->id,
            'academic_year_id' => $validated['academic_year_id'],
            'capacity' => $validated['capacity'],
        ];

        Classroom::create($classroomData);

        return redirect()->route('classrooms.index')->with('success', 'Classe créée avec succès.');
    }

    public function show(Classroom $classroom)
    {
        $classroom->load(['level', 'academicYear', 'students']);
        return view('classrooms.show', compact('classroom'));
    }

    public function edit(Classroom $classroom)
    {
        $academicYears = AcademicYear::all();
        return view('classrooms.edit', compact('classroom', 'academicYears'));
    }

    public function update(Request $request, Classroom $classroom)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'level_name' => 'required|string|max:50',
            'academic_year_id' => 'required|exists:academic_years,id',
            'capacity' => 'required|integer|min:1|max:100',
        ]);

        // Create or get the level
        $level = Level::firstOrCreate(
            ['name' => $validated['level_name']],
            ['cycle' => 'primaire'] // Default cycle
        );

        $classroomData = [
            'name' => $validated['name'],
            'level_id' => $level->id,
            'academic_year_id' => $validated['academic_year_id'],
            'capacity' => $validated['capacity'],
        ];

        $classroom->update($classroomData);

        return redirect()->route('classrooms.show', $classroom)->with('success', 'Classe mise à jour.');
    }

    public function destroy(Classroom $classroom)
    {
        $classroom->delete();
        return redirect()->route('classrooms.index')->with('success', 'Classe supprimée.');
    }
}
