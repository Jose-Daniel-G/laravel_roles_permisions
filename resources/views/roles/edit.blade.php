<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Roles / Edit
            </h2>
            <a href="{{ route('roles.index') }}"
                class="bg-slate-700 text-sm rounded-md px-5 py-3 text-white">Volver</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{route('roles.update', $role->id)}}" method="POST">
                        {{-- @method('POST') --}}
                        @csrf
                        <label for="name" class="text-lg font-medium">Nombre</label>
                        <div class="my-3">
                            <input value="{{ old('name',$role->name) }}" type="text" placeholder="Ingresa el nombre"
                                name="name" id="name" class="border-gray-300 shadow-sm w-1/2 rounded-lg">
                            @error('name')
                                <p class="text-red-400 font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="grid grid-cols-4 gap-2">
                            @if ($permissions->isNotEmpty())
                                @foreach ($permissions as $permission)
                                    <div class="mt-3">
                                        <input {{ $hasPermissions->contains($permission->name) ? 'checked':''}} type="checkbox" name="permission[]" id="permission-{{$permission->id}}"  class="rounded" value="{{ $permission->name }}">
                                        <label for="permission-{{$permission->id}}">{{ $permission->name }}</label>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        
                        <button class="bg-slate-700 hover:bg-slate-600 text-sm rounded-md px-5 py-3 text-white">Actualizar</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
