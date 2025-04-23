<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Articulos / Crear
            </h2>
            <a href="{{ route('articulos.index')}}" class="bg-slate-700 text-sm rounded-md px-5 py-3 text-white">Volver</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('articulos.store')}}" method="POST">
                        {{-- @method('POST') --}}
                        @csrf
                        <label for="titulo" class="text-lg font-medium">Titulo</label>
                        <div class="my-3">
                            <input value="{{old('titulo')}}" type="text" placeholder="titulo" name="titulo" id="titulo" class="border-gray-300 shadow-sm w-1/2 rounded-lg">
                            @error('titulo')
                                <p class="text-red-400 font-medium">{{$message}}</p>
                            @enderror
                        </div>
                        <label for="texto" class="text-lg font-medium">Content</label>
                        <div class="my-3">
                            <textarea name="text" id="text" cols="30" rows="10" placeholder="contenido" class="border-gray-300 shadow-sm w-1/2 rounded-lg">{{old('texto')}}</textarea>
                            @error('texto')
                                <p class="text-red-400 font-medium">{{$message}}</p>
                            @enderror
                        </div>
                        <label for="autor" class="text-lg font-medium">Autor</label>
                        <div class="my-3">
                            <input value="{{old('autor')}}" type="text" placeholder="autor" name="autor" id="autor" class="border-gray-300 shadow-sm w-1/2 rounded-lg">
                            @error('autor')
                                <p class="text-red-400 font-medium">{{$message}}</p>
                            @enderror
                        </div>
                        <button class="bg-slate-700 text-sm rounded-md px-5 py-3 text-white">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
