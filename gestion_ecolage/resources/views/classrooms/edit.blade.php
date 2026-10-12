@extends('layouts.app')

@section('page-title', 'Éditer ' . $classroom->name)

@section('content')
<div class="max-w-2xl mx-auto">
    <form method="POST" action="{{ route('classrooms.update', $classroom) }}" class="bg-white rounded-lg shadow p-6">
        @csrf
        @method('PUT')

        <div class="mb-6">
            <label for="name" class="block text-sm font-semibold text-gray-900 mb-2">
                Nom de la Classe *
            </label>
            <input type="text" id="name" name="name" value="{{ old('name', $classroom->name) }}"
                   class="w-full px-4 py-2 border @error('name') border-rose-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                   required>
            @error('name')
            <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label for="level_name" class="block text-sm font-semibold text-gray-900 mb-2">
                    Niveau *
                </label>
                <input type="text" id="level_name" name="level_name" 
                       value="{{ old('level_name', $classroom->level->name ?? '') }}"
                       class="w-full px-4 py-2 border @error('level_name') border-rose-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                       placeholder="Ex: 6ème, 5ème, Terminale, etc."
                       required>
                @error('level_name')
                <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="academic_year_id" class="block text-sm font-semibold text-gray-900 mb-2">
                    Année Académique *
                </label>
                <select id="academic_year_id" name="academic_year_id"
                        class="w-full px-4 py-2 border @error('academic_year_id') border-rose-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                        required>
                    @foreach($academicYears as $year)
                    <option value="{{ $year->id }}" @selected(old('academic_year_id', $classroom->academic_year_id) == $year->id)>
                        {{ $year->label }}
                    </option>
                    @endforeach
                </select>
                @error('academic_year_id')
                <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mb-6">
            <label for="capacity" class="block text-sm font-semibold text-gray-900 mb-2">
                Capacité Maximale *
            </label>
            <input type="number" id="capacity" name="capacity" value="{{ old('capacity', $classroom->capacity) }}"
                   class="w-full px-4 py-2 border @error('capacity') border-rose-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                   min="1" max="100"
                   required>
            @error('capacity')
            <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex gap-4 justify-end">
            <a href="{{ route('classrooms.show', $classroom) }}" 
               class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                Annuler
            </a>
            <button type="submit" 
                    class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition font-semibold">
                Mettre à Jour
            </button>
        </div>
    </form>
</div>
@endsection
