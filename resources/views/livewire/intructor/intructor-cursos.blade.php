<div class="container py-8">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mis cursos') }}
        </h2>
    </x-slot>
    <x-table-responsive>

        <div class="grid grid-cols-5">
            <div class="col-span-4">
                <x-input-search>
                    <input wire:model='search' type="text" id="table-search"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Buscar cursos..">
                </x-input-search>
            </div>
            <div class="ml-auto mt-4">
                <x-danger-button-enlace href="{{ route('instructor.cursos.admin.create') }}">Crear
                    curso</x-danger-button-enlace>
            </div>
        </div>

        @if ($cursos->count())
            <table class="w-full table text-gray-400 border-separate space-y-6 text-sm">
                <thead class="bg-gray-800 text-white ">
                    <tr>
                        <th class="p-3">NOMBRE</th>
                        <th class="p-3 text-left">MATRICULADOS</th>
                        <th class="p-3 text-left">CALIFICACION</th>
                        <th class="p-3 text-left">PRECIO</th>
                        <th class="p-3 text-left">ESTADO</th>
                        <th class="p-3 text-left">OPCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cursos as $curso)
                        <tr class="bg-gray-800">
                            <td class="p-3">
                                <div class="flex align-items-center">
                                    @isset($curso->image)
                                        <img class="rounded-full h-12 w-12  object-cover"
                                            src="{{ Storage::url($curso->image->url) }}" alt="unsplash image">
                                    @else
                                        <img class="rounded-full h-12 w-12  object-cover" src="" alt="pendiente">
                                    @endisset
                                    <div class="ml-3">
                                        <div class="">{{ $curso->title }}</div>
                                        <div class="text-gray-500">{{ $curso->categorie->name }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="p-3">
                                {{ $curso->students->count() }} Alumnos
                            </td>
                            <td class="p-3 ">
                                <div class="flex items-center">
                                    {{ $curso->rating }}
                                    <ul class="flex text-sm ml-2">
                                        <li class="mr-1"><i
                                                class="fas fa-star {{ $curso->rating >= 1 ? 'text-yellow-400' : 'text-gray-400' }}"></i>
                                        </li>
                                        <li class="mr-1"><i
                                                class="fas fa-star {{ $curso->rating >= 2 ? 'text-yellow-400' : 'text-gray-400' }}"></i>
                                        </li>
                                        <li class="mr-1"><i
                                                class="fas fa-star {{ $curso->rating >= 3 ? 'text-yellow-400' : 'text-gray-400' }}"></i>
                                        </li>
                                        <li class="mr-1"><i
                                                class="fas fa-star {{ $curso->rating >= 4 ? 'text-yellow-400' : 'text-gray-400' }}"></i>
                                        </li>
                                        <li class="mr-1"><i
                                                class="fas fa-star {{ $curso->rating == 5 ? 'text-yellow-400' : 'text-gray-400' }}"></i>
                                        </li>
                                    </ul>
                                </div>
                                <div class="text-gray-500">Valoración del curso</div>
                            </td>
                            <td class="p-3">
                                {{ $curso->price->name }}
                            </td>
                            <td class="p-3">
                                @switch($curso->status)
                                    @case(1)
                                        <span class="bg-red-400 text-red-800 text-sm rounded-md px-2">Borrador</span>
                                    @break

                                    @case(2)
                                        <span class="bg-yellow-300 text-yellow-800 text-sm rounded-md px-2">Revisión</span>
                                    @break

                                    @case(3)
                                        <span class="bg-green-300 text-green-800 text-sm rounded-md px-2">Publicado</span>
                                    @break

                                    @default
                                @endswitch
                            </td>
                            <td class="p-3 ">
                                <a href="{{ route('instructor.cursos.admin.show', $curso) }}"
                                    class="text-gray-400 hover:text-gray-100  mx-2">
                                    <i class="fa-regular fa-eye"></i>
                                </a>
                                <a  wire:click="$emit('deleteCurso',{{ $curso->id }})" class="text-gray-400 hover:text-gray-100  ml-2 cursor-pointer">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $cursos->links() }}
        @else
            <div class="p-4 mt-6 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
                role="alert">
                <span class="font-medium">Info alert!</span> No existen registros que coincidan con su busqueda.
            </div>
        @endif
    </x-table-responsive>
    <style>
        .table {
            border-spacing: 0 15px;
        }
    
        i {
            font-size: 1rem !important;
        }
    
        .table tr {
            border-radius: 20px;
        }
    
        tr td:nth-child(n+6),
        tr th:nth-child(n+6) {
            border-radius: 0 .625rem .625rem 0;
        }
    
        tr td:nth-child(1),
        tr th:nth-child(1) {
            border-radius: .625rem 0 0 .625rem;
        }
    </style>
</div>
@push('js')
    <script>
        Livewire.on('deleteCurso', sectionId => {
            Swal.fire({
                title: 'Segur@ deseas eliminar el registro?',
                text: "Puede tener registros asociados!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Elimina esto!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emitTo('intructor.intructor-cursos', 'delete', sectionId);
                }
            })
        });
    </script>
@endpush
