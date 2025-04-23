<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission as ModelsPermission;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::orderBy('created_at', 'ASC')->paginate(10);
        return view('roles.list', compact('roles'));
    }

    public function create()
    {
        $permissions = ModelsPermission::orderBy('name','ASC')->get();
        return view('roles.create',compact('permissions'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), ['name' => 'required|unique:roles|min:3']);

        if ($validator->passes()) {
            $role = Role::create(['name' => $request->name,
            'guard_name' => 'web', // <- necesario para evitar el error
        ]);
            if(!empty($request->permission)){
                foreach ($request->permission as $name) {
                    $role->givePermissionTo($name);
                }
            }
            return redirect()->route('roles.index')->with('success', 'Role añadido exitosamente');
        } else {
            return redirect()->route('roles.create')->withInput()->withErrors($validator);
        }
    }

    public function show(Role $role)
    {
        return view('roles.index');
    }

    public function edit($id) 
    {
        $role = Role::findOrFail($id);
        $hasPermissions = $role->permissions->pluck('name');
        $permissions = ModelsPermission::orderBy('name','ASC')->get();

        return view('roles.edit', compact('hasPermissions','permissions','role'));
    }

    public function update(Request $request, $id)
    {   
        $role = Role::findOrFail($id);
        $validator = Validator::make($request->all(),
         ['name' => 'required|unique:roles,name,'.$id.',id']);

        if ($validator->passes()) {
            $role->name = $request->name;
            $role->save();
            if (!empty($request->permission)) {
                $role->syncPermissions($request->permission);
            } else {
                $role->syncPermissions([]);
            }
            return redirect()->route('roles.index')->with('success', 'Role actualizado exitosamente');
        } else {
            return redirect()->route('roles.edit',$id)->withInput()->withErrors($validator);
        }
        return view('roles.index');
    }

    public function destroy(Request $request) {
        $id = $request->id;
    
        $role = Role::find($id);
    
        if ($role == null) {
            session()->flash('error', 'Role not found');
            // return response()->json([
            //     'status' => false
            // ]);
        }
    
        $role->delete();
    
        session()->flash('success', 'Role deleted successfully');
        return redirect()->back()->with('success', 'Role eliminado exitosamente.');
        // return response()->json([
        //     'status' => true
        // ]);
    }
}
