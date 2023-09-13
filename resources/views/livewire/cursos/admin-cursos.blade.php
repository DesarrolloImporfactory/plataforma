<div>
    @section('title', 'Dashboard')

    @section('content_header')
        <h1>Cursos pendientes de aprobación</h1>
    @stop

    <div class="card">
        <div class="card-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-8 col-md-8 col-lg-8 mt-2">
                        <div class="input-group">
                            <input wire:model="search" type="text" class="form-control form-control-sm"
                                placeholder="Buscar usuario.">
                        </div>
                    </div>
                    <div class="col-4 col-md-4 col-lg-4 mt-2">
                        {{-- @include('admin.user.create') --}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mt-2">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped text-center">
                                <thead class="thead-dark">
                                    <tr>
                                        <th style="cursor: pointer;" wire:click="order('id')">ID
                                            @if ($sort == 'id')
                                                @if ($direction == 'desc')
                                                    <i class="fa-solid fa-arrow-up-wide-short float-right"></i>
                                                @else
                                                    <i class="fa-solid fa-arrow-down-wide-short float-right"></i>
                                                @endif
                                            @else
                                                <i class="fa-solid fa-sort float-right"></i>
                                            @endif
                                        </th>
                                        <th style="cursor: pointer;" wire:click="order('name')">NAME
                                            @if ($sort == 'title')
                                                @if ($direction == 'desc')
                                                    <i class="fa-solid fa-arrow-up-wide-short float-right"></i>
                                                @else
                                                    <i class="fa-solid fa-arrow-down-wide-short float-right"></i>
                                                @endif
                                            @else
                                                <i class="fa-solid fa-sort float-right"></i>
                                            @endif
                                        </th>
                                        <th>PRECIO</th>
                                        <th>CATEGORIA</th>
                                        <th>OPTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($cursos->count())
                                        @foreach ($cursos as $item)
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->title }}</td>
                                                <td>{{ $item->price->name }}</td>
                                                <td>{{ $item->categorie->name }}</td>
                                                <td>
                                                    <a class="" href="#" role="button"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa-solid fa-bars"></i>
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a class="dropdown-item "
                                                                href="{{ route('admin.cursos.show', $item) }}"
                                                                type="button" ><i
                                                                    class="fa-solid fa-pen-to-square "></i>
                                                                Editar</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item "
                                                                wire:click="$emit('deleteUser',{{ $item->id }})"
                                                                type="button"><i class="fa-solid fa-trash"></i>
                                                                Eliminar</a>
                                                        </li>

                                                    </ul>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <div class="alert alert-danger">No existe coincidencias...</div>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-md-6">
                                    {{ $cursos->links() }}
                                </div>
                                <div class="col-md-6">
                                    <div class="float-end">
                                        Mostrando {{ $cursos->firstItem() }} a {{ $cursos->lastItem() }}
                                        del total de {{ $cursos->total() }} registros
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
    {{-- <script>
        Livewire.on('deleteUser', userId => {
            Swal.fire({
                title: 'Estas segur@?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Sí, bórralo!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emitTo('users.admin-users', 'delete', userId);
                }
            })
        });
    </script> --}}
@endpush
@push('css')
@endpush
