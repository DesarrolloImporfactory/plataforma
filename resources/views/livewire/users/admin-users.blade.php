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
                                                    <a  wire:click="asignar('{{ $item->id }}', '{{ $item->perfil_id }}')"
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
                                                        <a class="btn btn-sm btn-success" wire:click="$emit('cartera','{{ $item->id }}', '{{ $item->name }}')">Crear cartera</a>
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-info">No tiene cartera</span>
                                                    </td>
                                              
                                                    @else
                                                   @php
                                                    $total = 0;
                                                    $pagadooo   = 0;
                                                        @endphp
                                                    @foreach ($item->carteras as $cartera)
                                                        @php
                                                            $total += $cartera->abonos->sum('valor');
                                                            $pagadooo += $cartera->saldo
                                                        @endphp
                                                    @endforeach
                                                    <td>
                                                        <span class="badge bg-success">{{ $total }}</span>
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-danger">{{ $pagadooo }}</span>
                                                    </td>
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
<!-- Modal para crear cartera -->
<!-- Utiliza la clase 'show' de Bootstrap y estilos inline para controlar la visibilidad del modal -->
<div class="modal fade " id="crearCarteraModal" tabindex="-1" aria-labelledby="crearCarteraModalLabel" aria-hidden="true" >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="crearCarteraModalLabel">Crear Cartera</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form onsubmit="generarCartera(event)">
            @csrf
            <input type="hidden" id="userId" name="userId">
            <div class="mb-3">
              <label for="nombreUsuario" class="form-label">Nombre del Usuario</label>
              <input type="text" class="form-control" id="nombreUsuario" readonly>
            </div>
            <div class="mb-3">
              <label for="perfilSelect" class="form-label">Seleccionar Perfil</label>
              <select class="form-select" id="perfilSelect" >
                @foreach($names as $perfil)
                  <option value="{{ $perfil->id }}">{{ $perfil->name }}</option>
                @endforeach
              </select>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary" onclick="generarCartera(event)">Guardar</button>
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

        Livewire.on('cartera', (userId, userName) => {
            Livewire.emitTo('users.admin-users', 'cartera', (userId, userName));
            $('#nombreUsuario').val(userName);
            $('#userId').val(userId);
              $('#crearCarteraModal').modal('show');
        }
        );

        Livewire.on('asignar', (userId, perfilId) => {
            Livewire.emitTo('users.admin-users', 'asignar', userId, perfilId);
        });
        
        function generarCartera(event) {
            event.preventDefault();
            let perfil = $('#perfilSelect').val();
            let userId = $('#userId').val();
            Livewire.emitTo('users.admin-users','generarCartera', perfil, userId);
            // Cerrar el modal
            console.log(perfil, userId);
            $('#crearCarteraModal').modal('hide');
        }
    </script>
@endpush
@push('css')
@endpush
