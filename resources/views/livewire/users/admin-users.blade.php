@php
use Illuminate\Support\Str;
@endphp
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
                <b>GESTIÓN DE USUARIOS</b>
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
                                            <th>Enlace a Imporsuit</th>
                                            <th>SESSION</th>
                                            <th>ROL</th>
                                            <th>PERFIL</th>
                                            <th>Cartera - Pagado</th>
                                            <th>Cartera - Deuda</th>
                                            <th>Suscripcion - Estado</th>
                                            <th>Suscripcion - Días</th>
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
                                                    <td>@if($item->url && !Str::contains($item->url, 'registro') )
                                                        <a target="_black" href="{{$item->url }}/sysadmin"
                                                            class="btn btn-sm btn-primary">Ir a Imporsuit</a></td>
                                                    @elseif($item->url && Str::contains($item->url, 'registro'))
                                                        <a target="_black" href="{{$item->url }}"
                                                            class="btn btn-sm btn-info">Registro</a></td>
                                                    @else
                                                    <a target="_black" href="{{ route('admin.usuarios.show', $item->id) }}"
                                                        class="btn btn-sm btn-warning">Asignar</a>
                                                        @endif
                                                    </td>
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
                                                  
                                                    <td>{{ $item->perfils->name ?? 'Pendiente' }}</td>
                                                    @if($item->carteras->isEmpty())
                                                    <td>
                                                        <span class="badge bg-info">No tiene cartera</span>
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-info">No tiene cartera</span>
                                                    </td>
                                              
                                                    @else
                                                    @foreach ($item->carteras as $cartera)
                                                        <td>
                                                            <span class="badge bg-primary">{{ $cartera->abonos->sum('valor') }}</span>
                                                        </td>
                                                        <td>
                                                            <span class="badge bg-danger">{{ $cartera->saldo ?? '0' }}</span>
                                                        </td>
                                                    @endforeach
                                                    @endif
                                                    @if ($item->suscripcions->isEmpty())
                                                    <td>
                                                            <span class="badge bg-info">No tiene suscripcion</span>
                                                        </td>
                                                        <td>
                                                            <span class="badge bg-info">No tiene suscripcion</span>
                                                        </td>
                                                        @else
                                                            <td>
                                                                @if($item->suscripcions->first()->estado == 'activo')
                                                                
                                                                <span class="badge bg-success">{{ $item->suscripcions->first()->estado }}</span>
                                                                @else
                                                                <span class="badge bg-danger">{{ $item->suscripcions->first()->estado }}</span>
                                                                
                                                                @endif
                                                            </td>    
                                                            <td>
                                                                <span class="badge bg-primary">{{ $item->suscripcions->first()->dias }}</span>
                                                            </td>
                                                        @endif
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
