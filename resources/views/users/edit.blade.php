<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Usuarios / Editar
            </h2>
            <a href="{{ route('users.index') }}" class="bg-slate-700 text-sm rounded-md px-5 py-3 text-white">Volver</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                        {{-- @method('POST') --}}
                        @csrf
                        <label for="name" class="text-lg font-medium">Titulo</label>
                        <div class="my-3">
                            <input value="{{ old('name', $user->name) }}" type="text" placeholder="name"
                                name="name" id="name" class="border-gray-300 shadow-sm w-1/2 rounded-lg">
                            @error('name')
                                <p class="text-red-400 font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                        {{-- <label for="texto" class="text-lg font-medium">Content</label>
                        <div class="my-3">
                            <textarea name="texto" id="texto" cols="30" rows="10" placeholder="contenido" class="border-gray-300 shadow-sm w-1/2 rounded-lg">{{old('texto')}}</textarea>
                            @error('texto')
                                <p class="text-red-400 font-medium">{{$message}}</p>
                            @enderror
                        </div> --}}
                        <label for="email" class="text-lg font-medium">Correo</label>
                        <div class="my-3">
                            <input value="{{ old('email', $user->email) }}" type="text" placeholder="email"
                                name="email" id="email" class="border-gray-300 shadow-sm w-1/2 rounded-lg">
                            @error('email')
                                <p class="text-red-400 font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                        @if ($roles->isNotEmpty())
                            @foreach ($roles as $role)
                                <div class="mt-3">
                                    <input {{ $hasRoles->contains($role->id) ? 'checked':''}}  type="checkbox" name="role[]" id="role-{{ $role->id }}" class="rounded"
                                        value="{{ $role->name }}">
                                    <label for="role-{{ $role->id }}">{{ $role->name }}</label>
                                </div>
                            @endforeach
                        @endif
                        <button class="bg-slate-700 text-sm rounded-md px-5 py-3 text-white">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
