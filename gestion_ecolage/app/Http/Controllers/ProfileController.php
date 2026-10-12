<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'current_password' => 'nullable|required_with:password',
            'password' => 'nullable|confirmed|min:8',
        ]);

        // Check current password if user wants to change password
        if ($request->filled('current_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return redirect()->back()
                    ->withErrors(['current_password' => 'Le mot de passe actuel est incorrect.'])
                    ->withInput();
            }
            
            if (!$request->filled('password')) {
                return redirect()->back()
                    ->withErrors(['password' => 'Le nouveau mot de passe est requis.'])
                    ->withInput();
            }
        }

        // Handle photo upload
        if ($request->hasFile('photo')) {
            try {
                $file = $request->file('photo');
                // Delete old photo if exists
                if ($user->photo && file_exists(storage_path('app/public/' . $user->photo))) {
                    unlink(storage_path('app/public/' . $user->photo));
                }
                
                // Store the new photo
                $path = $file->store('users', 'public');
                $validated['photo'] = $path;
                
                // Ensure the file is readable
                @chmod(storage_path('app/public/' . $path), 0644);
            } catch (\Exception $e) {
                // Log the error but continue without updating photo
                \Illuminate\Support\Facades\Log::error('Photo upload failed: ' . $e->getMessage());
            }
        }

        // Prepare update data
        $updateData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
        ];

        // Add photo if updated
        if (isset($validated['photo'])) {
            $updateData['photo'] = $validated['photo'];
        }

        // Add password if being changed
        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($validated['password']);
        }

        // Update user with all data at once
        $user->update($updateData); // ✅ Approche Eloquent

        return redirect()->route('profile.edit')->with('success', 'Profil mis à jour avec succès.');
    }

    public function destroy()
    {
        // Note: Uncomment only if you want to allow account deletion
        // Auth::user()->delete();
        // Auth::logout();
        // return redirect('/');
    }
}
