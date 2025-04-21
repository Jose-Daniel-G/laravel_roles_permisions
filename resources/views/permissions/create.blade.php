<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Permissions / Crear
            </h2>
            <a href="{{ route('permissions.index')}}" class="bg-slate-700 text-sm rounded-md px-5 py-3 text-white">Volver</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('permissions.store')}}" method="POST">
                        {{-- @method('POST') --}}
                        @csrf
                        <label for="name" class="text-lg font-medium">Nombre</label>
                        <div class="my-3">
                            <input value="{{old('name')}}" type="text" placeholder="Ingresa el nombre" name="name" id="name" class="border-gray-300 shadow-sm w-1/2 rounded-lg">
                            @error('name')
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
