<div>
    @section('title', 'Alumnos')
    {{-- @include('admin.user.edit') --}}
    @if (session('mensaje'))
        <div class="alert alert-success mt-4">
            {{ session('mensaje') }}
        </div>
    @endif
    <div class="content-header">
        <div class="card">
            <div class="card-header">
                <b>GESTIÓN DE USUSARIOS</b>
            </div>
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
                            {{-- <button wire:click='suscripcion' class="btn btn-light">masivo</button> --}}
                            <a href="{{ route('admin.usuarios.crear') }}" class="btn btn-primary">Crear alumno</a>
                        </div>
                        <div wire:loading wire:target='suscripcion'>
                            loading-.....
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
                                            <th style="cursor: pointer;" wire:click="order('email')">EMAIL
                                                @if ($sort == 'email')
                                                    @if ($direction == 'desc')
                                                        <i class="fa-solid fa-arrow-up-wide-short float-right"></i>
                                                    @else
                                                        <i class="fa-solid fa-arrow-down-wide-short float-right"></i>
                                                    @endif
                                                @else
                                                    <i class="fa-solid fa-sort float-right"></i>
                                                @endif
                                            </th>
                                            <th>SESSION</th>
                                            <th>ROL</th>
                                            <th>PERFIL</th>
                                            <th>OPTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($usuarios->count())
                                            @foreach ($usuarios as $item)
                                                <tr>
                                                    <td>{{ $item->id }}</td>
                                                    <td>{{ $item->name }}</td>
                                                    <td>{{ $item->email }}</td>
                                                    <td><i
                                                            class="fa-regular  {{ $item->session ? 'fa-circle-check text-teal' : 'fa-circle-xmark text-danger' }} "></i>
                                                    </td>
                                                    <td>
                                                        @if (!empty($item->getRoleNames()))
                                                            @foreach ($item->getRoleNames() as $it)
                                                                <h5><span
                                                                        class="badge rounded-pill text-bg-success">{{ $it }}</span>
                                                                </h5>
                                                            @endforeach
                                                        @endif
                                                    </td>
                                                    <td>{{ $item->perfil_id ?? 'Pendiente' }}</td>
                                                    <td>
                                                        <a class="" href="#" role="button"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="fa-solid fa-bars"></i>
                                                        </a>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <a class="dropdown-item "
                                                                    href="{{ route('admin.usuarios.show', $item->id) }}"
                                                                    type="button"><i
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
                                        {{ $usuarios->links() }}
                                    </div>
                                    <div class="col-md-6">
                                        <div class="float-end">
                                            Mostrando {{ $usuarios->firstItem() }} a {{ $usuarios->lastItem() }}
                                            del total de {{ $usuarios->total() }} registros
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

</div>

@push('js')
    <script>
        Livewire.on('enviar-mensaje', userId => {
            console.log(userId);

        });
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
    </script>
@endpush
@push('css')
@endpush
