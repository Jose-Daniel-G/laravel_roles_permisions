<x-app-layout>
    <x-slot name="header">
<div class="flex justify-between">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Permissions') }}
    </h2>
    <a href="{{ route('permissions.create')}}" class="bg-slate-700 text-sm rounded-md px-5 py-3 text-white">Crear</a>
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
                                <th class="px-6 py-3 text-left">nombre</th>
                                <th class="px-6 py-3 text-left">Creacion</th>
                                <th class="px-6 py-3 text-center">Accion</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($permissions->isNotEmpty())
                                @foreach ($permissions as $permission)
                                <tr>
                                    <td  class="px-6 py-3 text-left">
                                        {{ $permission->id}}
                                    </td>
                                    <td  class="px-6 py-3 text-left">
                                        {{ $permission->name}}
                                    </td>
                                    <td  class="px-6 py-3 text-left">
                                        {{ \Carbon\Carbon::parse($permission->created_at)->format('d M, Y');}}
                                    </td>
                                    <td  class="px-6 py-3 text-left">
                                        <a href="{{ route('permissions.edit', $permission->id)}}" class="bg-slate-700 text-sm rounded-md px-5 py-3 py-2 hover:bg-slate-600">Editar</a>
                                        {{-- <a href="javascript:void(0)" onclick="deletePermission({{$permission->id}})" class="bg-red-600 text-sm rounded-md px-5 py-3 py-2 hover:bg-red-500">Eliminar</a> --}}
                                        <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-600 text-white text-sm rounded-md px-5 py-3 hover:bg-red-500">
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
                         {{ $permissions->links()}}
                    </div>
                   
            </div>
        </div>
    </div>
    <x-slot name="script">
        {{-- <script type="text/javascript">
            function deletePermission(id){
                if(confirm("Estas seguro, que lo desear borrar?")){
                    $.ajax({
                        url: '{{ route("permissions.destroy", ":id") }}'.replace(':id', id),
                        type: 'delete',
                        data: { id: id },
                        dataType: 'json',
                        headers:{
                            'x-csrf-token': {{ csrf_token() }}
                        },
                        success: function(response) {
                            window.location.href = '{{ route('permissions.index')}}';
                        }
                    });
                }
            }
        </script> --}}
    </x-slot>

</x-app-layout>
