<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArticuloController extends Controller
{
    public function index()
    {
        $articulos = Articulo::latest()->paginate(25); // Order by create_at DESC
        return view('articulos.list', compact('articulos'));
    }

    public function create()
    {
        // $permissions = ModelsPermission::orderBy('name','ASC')->get();
        // return view('roles.create',compact('permissions'));
        return view('articulos.create');
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'titulo' => 'required|min:5',
            'autor' => 'required|min:10'
        ]);
    
        if ($validator->passes()) {
            $article = new Articulo();
            $article->titulo = $request->titulo;
            $article->texto = $request->texto;
            $article->autor = $request->autor;
            $article->save();
            return redirect()->route('articles.index')->with('success','Articulo anadido exitosamente.!');
        } else {
            return redirect()->route('articles.create')->withInput()->withErrors($validator);
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
