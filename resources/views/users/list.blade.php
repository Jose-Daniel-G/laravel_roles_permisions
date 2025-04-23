<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Users') }}
            </h2>
            @can('users.create')
                <a href="{{ route('users.create') }}" class="bg-slate-700 text-sm rounded-md px-5 py-3 text-white">Crear</a>
            @endcan
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-message></x-message>
            {{-- @if (session('success'))
                <div class="bg-green-200 border-green-600 p-4 mb-3 rounded-sm shadow-sm">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-200 border-red-600 p-4 mb-3 rounded-sm shadow-sm">
                    {{ session('error') }}
                </div>
            @endif --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr class="border-b">
                            <th class="px-6 py-3 text-left">#</th>
                            <th class="px-6 py-3 text-left">Nombre</th>
                            <th class="px-6 py-3 text-left">Correo</th>
                            <th class="px-6 py-3 text-left">Roles</th>
                            <th class="px-6 py-3 text-left">Creado</th>
                            <th class="px-6 py-3 text-center">Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($users->isNotEmpty())
                            @foreach ($users as $user)
                                <tr>
                                    <td class="px-6 py-3 text-left">
                                        {{ $user->id }}
                                    </td>
                                    <td class="px-6 py-3 text-left">
                                        {{ $user->name }}
                                    </td>
                                    <td class="px-6 py-3 text-left">
                                        {{ $user->email }}
                                    </td>
                                    <td class="px-6 py-3 text-left">
                                        {{ $user->roles->pluck('name')->implode(', ') }}
                                    </td>
                                    <td class="px-6 py-3 text-left">
                                        {{ \Carbon\Carbon::parse($user->created_at)->format('d M, Y') }}
                                    </td>
                                    <td class="px-6 py-3 text-left">
                                        <a href="{{ route('users.edit', $user->id) }}"
                                            class="bg-slate-700 text-sm rounded-md px-5 py-3 py-2 hover:bg-slate-600">Editar</a>
                                        {{-- <a href="javascript:void(0)" onclick="deletePermission({{$user->id}})" class="bg-red-600 text-sm rounded-md px-5 py-3 py-2 hover:bg-red-500">Eliminar</a> --}}
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-600 text-white text-sm rounded-md px-5 py-3 hover:bg-red-500">
                                                Eliminar
                                            </button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                <div class="my-3">
                    {{ $users->links() }}
                </div>

            </div>
        </div>
    </div>
    <x-slot name="script">
        {{-- <script type="text/javascript">
            function deletePermission(id){
                if(confirm("Estas seguro, que lo desear borrar?")){
                    $.ajax({
                        url: '{{ route("users.destroy", ":id") }}'.replace(':id', id),
                        type: 'delete',
                        data: { id: id },
                        dataType: 'json',
                        headers:{
                            'x-csrf-token': {{ csrf_token() }}
                        },
                        success: function(response) {
                            window.location.href = '{{ route('users.index')}}';
                        }
                    });
                }
            }
        </script> --}}
    </x-slot>

</x-app-layout>
