<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ArticuloController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:articulos.index', only: ['index']),
            new Middleware('permission:articulos.edit', only: ['edit']),
            new Middleware('permission:articulos.create', only: ['create']),
            new Middleware('permission:articulos.delete', only: ['destroy']),
        ];
    }

    public function index()
    {
        $articulos = Articulo::latest()->paginate(25); // Order by create_at DESC
        return view('articulos.list', compact('articulos'));
    }

    public function create()
    {
        // $permissions = ModelsPermission::orderBy('name','ASC')->get();
        // return view('articulos.create',compact('permissions'));
        return view('articulos.create');
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'titulo' => 'required|min:5',
            'autor' => 'required|min:10'
        ]);

        if ($validator->passes()) {
            $articulo = new Articulo();
            $articulo->titulo = $request->titulo;
            $articulo->texto = $request->texto;
            $articulo->autor = $request->autor;
            $articulo->save();
            return redirect()->route('articulos.index')->with('success', 'Articulo anadido exitosamente.!');
        } else {
            return redirect()->route('articulos.create')->withInput()->withErrors($validator);
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $articulo = Articulo::findOrFail($id);

        return view('articulos.edit', compact('articulo'));
    }

    public function update(Request $request, $id)
    {
        $articulo = Articulo::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'titulo' => 'required|min:5',
            'autor' => 'required|min:10'
        ]);

        if ($validator->passes()) {
            $articulo->titulo = $request->titulo;
            $articulo->texto = $request->texto;
            $articulo->autor = $request->autor;
            $articulo->save();

            return redirect()->route('articulos.index')->with('success', 'Articulo actualizado exitosamente');
        } else {
            return redirect()->route('articulos.edit', $id)->withInput()->withErrors($validator);
        }
        return view('articulos.index');
    }

    public function destroy(Request $request)
    {
        $id = $request->id;

        $articulo = Articulo::find($id);

        if ($articulo == null) {
            session()->flash('error', 'Role not found');
            // return response()->json([
            //     'status' => false
            // ]);
        }

        $articulo->delete();

        session()->flash('success', 'Role deleted successfully');
        return redirect()->back()->with('success', 'Role eliminado exitosamente.');
        // return response()->json([
        //     'status' => true
        // ]);
    }
}
