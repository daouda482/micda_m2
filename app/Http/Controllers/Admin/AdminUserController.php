<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'prenom' => 'nullable|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'role' => 'required|in:admin,recruteur,candidat',
            'adresse' => 'string|max:255|nullable',
            'phone' => 'string|max:30|nullable',
            'photo' => 'image|nullable',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'prenom' => $request->prenom,
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'adresse' => $request->adresse,
            'phone' => $request->phone,
            'photo' => $request->file('photo') ? $request->file('photo')->store('photos', 'public') : null,
            'account_status' => 'active',
            'email_verified_at' => now(),
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Utilisateur créé avec succès');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'prenom' => 'nullable|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'role' => 'required|in:admin,recruteur,candidat',
            'adresse' => 'string|max:255|nullable',
            'phone' => 'string|max:30|nullable',
            'photo' => 'image|nullable',
        ]);

        $user->update([
            'prenom' => $request->prenom,
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'adresse' => $request->adresse,
            'phone' => $request->phone,
            'photo' => $request->file('photo') ? $request->file('photo')->store('photos', 'public') : $user->photo,
            'account_status' => $user->account_status, // Keep the existing status
            'email_verified_at' => $user->email_verified_at ?: now(),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Utilisateur mis à jour avec succès');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Utilisateur supprimé avec succès');
    }
}
