<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $users = User::paginate(10); // Adjust the number to control how many users per page
    return view('users.index', compact('users'));
}

public function show($id)
{
    $user = User::findOrFail($id);
    return view('users.show', compact('user'));
}

public function create()
{
    return view('users.create');
}

public function store(Request $request)
{
    $validatedData = $request->validate([
        'prefixname' => 'nullable|string|max:255',
        'firstname' => 'required|string|max:255',
        'middlename' => 'nullable|string|max:255',
        'lastname' => 'required|string|max:255',
        'suffixname' => 'nullable|string|max:255',
        'username' => 'required|string|max:255|unique:users',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8',
        'type' => 'nullable|string|in:user,admin',
        'photo' => 'nullable|image|max:2048', // assuming photo upload
    ]);

    $user = new User($validatedData);
    $user->password = bcrypt($request->password); // Hash the password

    if ($request->hasFile('photo')) {
        $user->photo = $request->file('photo')->store('photos', 'public'); // Store the photo
    }

    $user->save();

    return redirect()->route('users.index')->with('success', 'User registered successfully');
}

public function edit($id)
{
    $user = User::findOrFail($id);
    return view('users.edit', compact('user'));
}

public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    $validated = $request->validate([
        'prefixname' => 'nullable|in:Mr,Mrs,Ms',
        'firstname' => 'required|string|max:255',
        'middlename' => 'nullable|string|max:255',
        'lastname' => 'required|string|max:255',
        'suffixname' => 'nullable|string|max:255',
        'username' => 'required|string|max:255|unique:users,username,' . $user->id,
        'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        'password' => 'nullable|string|min:8',
        'photo' => 'nullable|image',
        'type' => 'nullable|string|in:user,admin',
    ]);

    // If a new password is provided, hash it and include it in the update.
    if ($request->filled('password')) {
        $validated['password'] = Hash::make($validated['password']);
    } else {
        // If no new password is provided, remove the password from the validated data
        unset($validated['password']);
    }
    if ($request->hasFile('photo')) {
        $validated['photo'] = $request->file('photo')->store('photos', 'public');
    }

    $user->update($validated);

    return redirect()->route('users.index')->with('success', 'User updated successfully.');
}

public function destroy($id)
{
    $user = User::findOrFail($id);
    $user->delete();

    return redirect()->route('users.index')->with('success', 'User deleted successfully.');
}

// Method to show trashed users
public function trashed()
{
    $trashedUsers = User::onlyTrashed()->get();
    return view('users.trashed', compact('trashedUsers'));
}

// Method to restore a trashed user
public function restore($userId)
{
    $user = User::onlyTrashed()->findOrFail($userId);
    $user->restore();
    return redirect()->route('users.trashed')->with('success', 'User restored successfully.');
}

// Method to permanently delete a trashed user
public function delete($userId)
{
    $user = User::onlyTrashed()->findOrFail($userId);
    $user->forceDelete();
    return redirect()->route('users.trashed')->with('success', 'User permanently deleted.');
}

}
