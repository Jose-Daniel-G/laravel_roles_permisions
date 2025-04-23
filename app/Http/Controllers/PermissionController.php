<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
class PermissionController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:permissions.index', only: ['index']),
            new Middleware('permission:permissions.edit', only: ['edit']),
            new Middleware('permission:permissions.create', only: ['create']),
            new Middleware('permission:permissions.delete', only: ['destroy']),
        ];
    }
    public function index()
    {
        $permissions = Permission::orderBy('created_at', 'DESC')->paginate(10);
        return view('permissions.list', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:permissions|min:3'
        ]);

        if ($validator->passes()) {
            Permission::create([
                'name' => $request->name,
                'guard_name' => 'web', // <- necesario para evitar el error
            ]);
            return redirect()->route('permissions.index')->with('success', 'Permiso añadido exitosamente');
        } else {
            return redirect()->route('permissions.index')->withInput()->withErrors($validator);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
        return view('permissions.create');
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(Permission $permission)
    public function edit($id)
    {
        $permission = Permission::findOrfail($id);
        // dd($permission->id);
        // dd($id);
        return view('permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $permission = Permission::findOrfail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|unique:permissions,name,' . $id . ',id'
        ]);
        if ($validator->passes()) {
            $permission->name = $request->name;
            $permission->guard_name ='web'; // <- necesario para evitar el error

            $permission->save();
            return redirect()->route('permissions.index')->with('success','Permiso Actualizado exitosamente.');
        } else {
            return redirect()->route('permissions.edit',$id)->withInput()->withErrors($validator);
        }
    }

    public function destroy(Request $request) {
        $id = $request->id;
    
        $permission = Permission::find($id);
    
        if ($permission == null) {
            session()->flash('error', 'Permission not found');
            return response()->json([
                'status' => false
            ]);
        }
    
        $permission->delete();
    
        session()->flash('success', 'Permission deleted successfully');
        return redirect()->back()->with('success', 'Permiso eliminado exitosamente.');
        // return response()->json([
        //     'status' => true
        // ]);
    }
    // public function destroy(Permission $permission)
    // {
    //     $permission->delete();
    //     return redirect()->route('permissions.index')->with('success', 'Permiso eliminado exitosamente.');
    // }
}
