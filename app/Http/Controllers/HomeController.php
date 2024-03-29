<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Title;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the homepage with user data.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $users = User::with('title')->get();

        return view('homepage', ['users' => $users]);
    }

    /**
     * Store a newly created user in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
   // ...

public function addUser(Request $request)
{
    // Validate the form data
    $validatedData = $request->validate([
        'name' => 'required|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:8',
        'avatar' => 'nullable|image|max:2048',
        'title_id' => 'required|exists:titles,id',
    ]);

    // Handle the avatar upload
    if ($request->hasFile('avatar')) {
        $avatar = $request->file('avatar');
        $avatarPath = $avatar->store('public/avatars');
        $validatedData['avatar'] = basename($avatarPath);
    }

    // Hash the password
    $validatedData['password'] = bcrypt($validatedData['password']);

    // Create a new User instance
    $user = new User($validatedData);
    $user->save();

    // Optionally, you can redirect or return a response
    return redirect()->route('home')->with('success', 'User added successfully!');
}

public function showAddPage()
{
    $titles = Title::all(); // Fetch all titles from the database
    return view('addpage', compact('titles')); // Pass $titles to the view
}

public function deleteUser($id)
{
    $user = User::findOrFail($id);
    $user->delete();

    return response()->json(['message' => 'User deleted successfully']);
}
/**
 * Show the edit form for the specified user.
 *
 * @param  int  $id
 * @return \Illuminate\View\View
 */
public function editUser($id)
{
    $user = User::findOrFail($id);
    $titles = Title::all();

    return view('editpage', compact('user', 'titles'));
}

/**
 * Update the specified user in the database.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  int  $id
 * @return \Illuminate\Http\RedirectResponse
 */
public function updateUser(Request $request, $id)
{
    $validatedData = $request->validate([
        'name' => 'required|max:255',
        'email' => 'required|email|unique:users,email,' . $id,
        'password' => 'nullable|min:8',
        'avatar' => 'nullable|image|max:2048',
        'title_id' => 'required|exists:titles,id',
    ]);

    $user = User::findOrFail($id);

    if ($request->hasFile('avatar')) {
        $avatar = $request->file('avatar');
        $avatarPath = $avatar->store('public/avatars');
        $validatedData['avatar'] = basename($avatarPath);
    }

    if ($request->filled('password')) {
        $validatedData['password'] = bcrypt($validatedData['password']);
    } else {
        unset($validatedData['password']);
    }

    $user->update($validatedData);

    return redirect()->route('home')->with('success', 'User updated successfully!');
}
// ...
}
