<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('is_active', 1)->get();

        return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::get();
        $user = new User();

        return view('users.create', compact('roles', 'user'));
    }

    public function store(Request $request)
    {
        $attr = $request->validate([
            'username' => 'required|unique:users',
            'name' => 'required',
            'password' => 'required',
            'role' => 'required',
            'photo.*' => 'required|mimes:png, jpg, jpeg',
        ]);

        try {
            DB::beginTransaction();
            $user = User::create($attr);

            $user->assignRole($request->role);
            DB::commit();

            return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function show(User $user)
    {
        //
    }

    public function edit(User $user)
    {
        $roles = Role::get();

        return view('users.edit', compact('roles', 'user'));
    }

    public function update(Request $request, User $user)
    {
        $attr = $request->validate([
            'username' => 'required|unique:users,username,' . $user->id,
            'name' => 'required',
            'role' => 'required',
            'photo' => 'mimes:png, jpg, jpeg',
        ]);

        try {
            DB::beginTransaction();
            if ($request->file('photo')) {
                $photo = $request->file('photo');
                $attr['photo'] = $photo->storeAs('images/users', Str::slug($request->name) . '-' . date('YmdHis') . '.' . $photo->getExtension());
            } else {
                $attr['photo'] = $user->photo;
            }

            if ($request->password) {
                $attr['password'] = bcrypt('password');
            } else {
                $attr['password'] = $user->password;
            }

            $user->update($attr);

            $user->syncRoles($request->role);
            DB::commit();

            return redirect()->route('user.index')->with('success', 'User berhasil diupdate');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function destroy(User $user)
    {
        //
    }
}
