<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class UserController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:users.index', only: ['index']),
            new Middleware('permission:users.edit', only: ['edit']),
            new Middleware('permission:users.create', only: ['create']),
            new Middleware('permission:users.delete', only: ['destroy']),
            // new Middleware('permission:roles.create', only: ['create']),
            // new Middleware('permission:roles.delete', only: ['destroy']),
        ];
    }

    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('users.list', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        return view('users.list');
    }

    public function show(string $id)
    {
        return view('users.list');
    }

    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $roles = Role::orderBy('name', 'ASC')->get();
        $hasRoles = $user->roles->pluck('id');
        // dd($hasRoles);
        return view('users.edit', compact('user', 'roles', 'hasRoles'));
    }

    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,' . $id . ',id'
        ]);

        if ($validator->fails()) {
            return redirect()->route('users.edit', $id)->withInput()->withErrors($validator);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        $user->syncRoles($request->role);
        return redirect()->route('users.index')->with('success', 'Usuario actualizado exitosamente.!');
    }
    public function destroy(string $id)
    {
        return view('users.list');
    }
}
