<div>
    @include('admin.setings.levelEdit')
    <div class="card">
        <div class="card-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-8 col-md-8 col-lg-8 mt-2">
                        <div class="input-group">
                            <input wire:model="search" type="text" class="form-control form-control-sm"
                                placeholder="Buscar...">
                        </div>
                    </div>
                    <div class="col-4 col-md-4 col-lg-4 mt-2">
                        @include('admin.setings.levelCreate')
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mt-4">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped text-center">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>NAME </th>
                                        <th>OPTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($levels->count())
                                        @foreach ($levels as $item)
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td style="width: 100px;">
                                                    <div class="btn-group btn-group-sm" role="group"
                                                        aria-label="Basic example">
                                                        <button class="btn btn-xs btn-default text-primary mx-1 shadow"
                                                            wire:click="show({{ $item->id }})" type="button"
                                                            data-bs-toggle="modal" data-bs-target="#editLevel"><i
                                                                class="fa-solid fa-pen-to-square"></i></button>
                                                        <button class="btn btn-xs btn-default text-danger mx-1 shadow"
                                                            wire:click="$emit('deleteLevel',{{ $item->id }})"
                                                            type="button"><i class="fa-solid fa-trash"></i></button>
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
                                {{ $levels->links() }}
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
        Livewire.on('deleteLevel', codigo => {
            Swal.fire({
                title: 'Esta seguro de eliminar?',
                text: "No habra forma de revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Eliminalo!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emitTo('admin.level-admin', 'delete', codigo);
                }
            })
        })
    </script>
@endpush
