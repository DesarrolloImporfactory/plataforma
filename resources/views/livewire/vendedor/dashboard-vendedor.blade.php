<div class="container py-8">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard vendedor') }}
        </h2>
    </x-slot>
    <div class="py-4">
        <div class="grid lg:grid-cols-2 sm:grid-cols-1 md:grid-cols-2 gap-4">
            <div class="">
                <h1 class="text-2xl dark:text-white font-bold">Mis comisiones</h1>
                <div class="shadow rounded">
                    <div class="py-4 px-2">
                        <div class="dark:bg-gray-300 shadow rounded">
                            <div class="px-2 py-2 flex justify-between items-center text-gray-700">
                                <div class="">

                                </div>
                                <div class="items-center justify-between">
                                    USD {{ $comisionSuma }}$
                                </div>
                            </div>
                        </div>
                        <div class="relative overflow-x-auto sm:rounded-lg">
                            <div class="col-span-12">
                                <div class="overflow-auto lg:overflow-visible ">
                                    <table class="w-full table dark:text-gray-400 border-separate space-y-6 text-sm">
                                        <thead class="dark:bg-gray-800 bg-gray-200 dark:text-white ">
                                            <tr>
                                                <th class="p-3">ID</th>
                                                <th class="p-3 text-left">COMISIÓN</th>
                                                <th class="p-3 text-left">TIPO</th>
                                                <th class="p-3 text-left">ALUMNO</th>
                                                <th class="p-3 text-left">FECHA</th>
                                                <th class="p-3 text-left"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($comisiones as $item)
                                                <tr class="dark:bg-gray-800 bg-gray-200">
                                                    <td class="p-3">
                                                        {{ $item->id }}
                                                    </td>
                                                    <td class="p-3">
                                                        {{ $item->valor }}
                                                    </td>
                                                    <td class="p-3 ">{{ $item->tipos->name }}</td>
                                                    <td class="p-3">
                                                        {{ $item->cartera->alumnos->name }}
                                                    </td>
                                                    <td class="p-3">
                                                        {{ $item->cartera->fecha }}
                                                    </td>
                                                    <td class="p-3">
                                                        <a href="{{route('admin.usuarios.show',$item->cartera->alumno_id)}}" class="btn btn-primary"><i class="fa-regular fa-eye"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="container py-4">
                        {{ $comisiones->links() }}
                    </div>
                </div>
            </div>
            <div>
                <div
                    class="container grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-x-6 gap-y-8 mt-6">
                    <div class="flex flex-row bg-white shadow-sm rounded p-4 border-indigo-600 leading-7 border-l-4">
                        <div
                            class="flex items-center justify-center flex-shrink-0 h-12 w-12 rounded-xl bg-blue-100 text-blue-500">
                            <i class="fa-solid fa-users"></i>
                        </div>
                        <div class="flex flex-col flex-grow ml-4">
                            <div class="text-sm text-gray-500">Alumnos</div>
                            <div class="font-bold text-lg">{{$comisiones->count()}}</div>
                        </div>
                    </div>
                    <div class="flex flex-row bg-white shadow-sm rounded p-4 border-indigo-600 leading-7 border-l-4">
                        <div
                            class="flex items-center justify-center flex-shrink-0 h-12 w-12 rounded-xl bg-blue-100 text-blue-500">
                            <i class="fa-solid fa-sack-dollar"></i>
                        </div>
                        <div class="flex flex-col flex-grow ml-4">
                            <div class="text-sm text-gray-500">Ventas</div>
                            <div class="font-bold text-lg">USD {{$sumaVenta}}$</div>
                        </div>
                    </div>
                    <div class="flex flex-row bg-white shadow-sm rounded p-4 border-indigo-600 leading-7 border-l-4">
                        <div
                            class="flex items-center justify-center flex-shrink-5 h-12 w-12 rounded-xl bg-blue-100 text-blue-500">
                            <i class="fa-solid fa-circle-exclamation"></i>
                        </div>
                        <div class="flex flex-col flex-grow ml-4">
                            <div class="text-sm text-gray-500">Cobros pendientes</div>
                            <div class="font-bold text-lg">{{$pendiente}}</div>
                        </div>
                    </div>

                    <div class="flex flex-row bg-white shadow-sm rounded p-4 border-indigo-600 leading-7 border-l-4">
                        <div
                            class="flex items-center justify-center flex-shrink-0 h-12 w-12 rounded-xl bg-blue-100 text-blue-500">
                            <i class="fa-solid fa-money-bills"></i>
                        </div>
                        <div class="flex flex-col flex-grow ml-4">
                            <div class="text-sm text-gray-500">Cobros pendientes</div>
                            <div class="font-bold text-lg">USD {{$cobrosPendientes}}$</div>
                        </div>
                    </div>
                </div>
            </div>
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
        </script>
    @endpush
