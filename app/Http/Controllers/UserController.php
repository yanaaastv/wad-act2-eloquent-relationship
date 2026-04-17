<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller {

    private function isAdmin()
{
    return Auth::check() && Auth::user()->role === 'admin';
}

    public function index()
    {
        if (!$this->isAdmin()) {
            return redirect('/dashboard'); // or abort(403);
        }

        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        if (!$this->isAdmin()) {
            return redirect('/dashboard');
        }

        return view('users.create');
    }

    public function show(User $user)
    {
        if (!$this->isAdmin()) {
            return redirect('/dashboard');
        }

        return view('users.show', compact('user'));
    }

    public function store(Request $request)
    {
        if (!$this->isAdmin()) {
            return redirect('/dashboard');
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', Rules\Password::defaults()],
            'role' => ['required', 'in:admin,user'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully!');
    }

    public function edit(User $user)
    {
        if (!$this->isAdmin()) {
            return redirect('/dashboard');
        }

        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        if (!$this->isAdmin()) {
            return redirect('/dashboard');
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'role' => ['required', 'in:admin,user'],
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        if ($request->filled('password')) {
            $request->validate([
                'password' => [Rules\Password::defaults()],
            ]);

            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()->route('users.index')->with('success', 'User updated successfully!');
    }

    public function destroy(User $user)
    {
        if (!$this->isAdmin()) {
            return redirect('/dashboard');
        }

        if (Auth::user()->id === $user->id) {
            return redirect()->route('users.index')
                ->with('error', 'You cannot delete your own account while logged in!');
        }

        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'User has been deleted successfully.');
    }
}
