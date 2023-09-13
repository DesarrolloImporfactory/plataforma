<div>
    <x-slot name="curso">
        {{ $curso->id }}
    </x-slot>
    <div class="flex items-center p-4  text-sm @switch($curso->status)
        @case(1)
        text-gray-800 bg-gray-50 dark:bg-gray-800 dark:text-gray-400
            @break
        @case(2)
        text-yellow-800 bg-yellow-50 dark:bg-gray-800 dark:text-yellow-400
            @break
            @case(3)
            text-green-800 bg-green-50 dark:bg-gray-800 dark:text-green-400
            @break
        @default
            
    @endswitch  rounded-lg"
        role="alert">
        <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
            fill="currentColor" viewBox="0 0 20 20">
            <path
                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
        </svg>

        <span class="sr-only">Info</span>
        @switch($curso->status)
            @case(1)
                <div>
                    <span class="font-medium">Warning alert!</span> Este curso esta pendiente.
                </div>
            @break

            @case(2)
                <div>
                    <span class="font-medium">pending alert!</span> Este curso esta en revisión.
                </div>
            @break

            @case(3)
                <div>
                    <span class="font-medium">Success alert!</span> Este curso esta aprobado.
                </div>
            @break

            @default
        @endswitch
    </div>
    <div class="px-6 py-4 text-gray-600">
        <h1 class="text-2xl font-bold text-white"><i class="fa-solid fa-circle-info mr-2"></i>ESTUDIANTES DEL CURSO</h1>
        <hr class="mt-2 mb-6">

        <x-table-responsive>

            <div class="grid grid-cols-5">
                <div class="col-span-4">
                    <x-input-search>
                        <input wire:model='search' type="text" id="table-search"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Buscar estudiante..">
                    </x-input-search>
                </div>
            </div>

            @if ($estudiantes->count())
                <table class="w-full table text-gray-400 border-separate space-y-6 text-sm">
                    <thead class="dark:bg-gray-900 text-white ">
                        <tr>
                            <th class="p-3">NOMBRE</th>
                            <th class="p-3 text-left">EMAIL</th>
                            <th class="p-3 text-left">OPCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($estudiantes as $estudiante)
                            <tr class="bg-gray-800">
                                <td class="p-3">
                                    <div class="flex align-items-center">
                                        <img class="rounded-full h-12 w-12  object-cover"
                                            src="{{ $estudiante->profile_photo_url }}" alt="unsplash image">
                                        <div class="ml-3 mt-3">
                                            <div class="">{{ $estudiante->name }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-3">
                                    {{ $estudiante->email }}
                                </td>

                                <td class="p-3 ">
                                    <a href="{{ route('instructor.cursos.admin.show', $estudiante) }}"
                                        class="text-gray-400 hover:text-gray-100  mx-2">
                                        <i class="fa-regular fa-eye"></i>
                                    </a>
                                    <a href="#" class="text-gray-400 hover:text-gray-100  ml-2">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $estudiantes->links() }}
            @else
                <div class="p-4 mt-6 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
                    role="alert">
                    <span class="font-medium">Info alert!</span> No existen registros que coincidan con su busqueda.
                </div>
            @endif
        </x-table-responsive>
    </div>
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

        tr td:nth-child(n+3),
        tr th:nth-child(n+3) {
            border-radius: 0 .625rem .625rem 0;
        }

        tr td:nth-child(1),
        tr th:nth-child(1) {
            border-radius: .625rem 0 0 .625rem;
        }
    </style>
</div>
