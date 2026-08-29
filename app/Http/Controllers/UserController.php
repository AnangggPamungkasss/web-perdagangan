<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user; 
use App\Models\Role;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::with('role');

        if ($request->has('search') && $request->search != '') {
            $query->where('email', 'like', '%' . $request->search . '%');
        }

        $user = $query->get(); 
        return view('admin.user', compact('user'));
    }

    public function tambah_user()
    {
        $roles = Role::all();
        return view('admin.tambah_user', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role_id' => 'required|exists:roles,id',
            'security_question' => 'required',
            'security_answer' => 'required'
        ]);
    
        User::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $request->role_id, 
            'security_question' => $request->security_question,
            'security_answer' => $request->security_answer
        ]);
    
        return redirect()->route('dashboard.user')->with('success', 'User berhasil ditambahkan!');
    }


    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.edit_user', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'email' => 'required|email', 
            'password' => 'nullable|min:6',
            'security_question' => 'required|string',
            'security_answer' => 'required|string'
        ]);

        $user = User::findOrFail($id); 
        $user->update([
            'email' => $request->email,
            'security_question' => $request->security_question,
            'security_answer' => $request->security_answer
        ]);

        if ($request->password) {
            $user->password = bcrypt($request->password); 
        }

        $user->save();

        return redirect()->route('dashboard.user')->with('success', 'User berhasil diperbarui!');
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('dashboard.user')->with('success', 'User berhasil dihapus!');
    }
}
