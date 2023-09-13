<div>
    @section('title', 'Roles y permisos')
    @include('admin.roles.edit')
    <div class="content-header">
        <div class="card">
            <div class="card-header">
                <b>GESTIÓN DE ROLES Y PERMISOS</b>
            </div>
            <div class="card-body">
                <div class="container-fluid">
                    <div class="d-flex">
                        <div class="mt-2 flex-grow-1">
                            <div class="input-group">
                                <input wire:model="search" type="text" class="form-control "
                                    placeholder="Buscar.........">
                            </div>
                        </div>
                        <div class="mt-2 ml-3 ">
                            @include('admin.roles.create')
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
                                                @if ($sort == 'name')
                                                    @if ($direction == 'desc')
                                                        <i class="fa-solid fa-arrow-up-wide-short float-right"></i>
                                                    @else
                                                        <i class="fa-solid fa-arrow-down-wide-short float-right"></i>
                                                    @endif
                                                @else
                                                    <i class="fa-solid fa-sort float-right"></i>
                                                @endif
                                            </th>
                                            <th>OPTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($roles->count())
                                            @foreach ($roles as $item)
                                                <tr>
                                                    <td>{{ $item->id }}</td>
                                                    <td>{{ $item->name }}</td>
                                                    <td style="width: 100px;">
                                                        <div class="btn-group btn-group-sm" role="group"
                                                            aria-label="Basic example">
                                                            <button
                                                                class="btn btn-xs btn-default text-primary mx-1 shadow"
                                                                wire:click="edit({{ $item->id }})" type="button"
                                                                data-bs-toggle="modal" data-bs-target="#editModal"><i
                                                                    class="fa-solid fa-pen-to-square"></i></button>
                                                            <button
                                                                class="btn btn-xs btn-default text-danger mx-1 shadow"
                                                                wire:click="$emit('deleteRol',{{ $item->id }})"
                                                                type="button"><i
                                                                    class="fa-solid fa-trash"></i></button>
                                                        </div>
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
                                <div>
                                    {{ $roles->links() }}
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
    <script>
        Livewire.on('deleteRol', userId => {

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
                    Livewire.emitTo('roles.admin-roles', 'delete', userId);
                }
            })
        });
    </script>
@endpush
