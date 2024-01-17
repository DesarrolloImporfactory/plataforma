<div>
    @section('title', 'Alumnos')
    <div class="content-header">
        <div class="card">
            <div class="card-header">
                <b>GESTIÓN DE ALUMNOS</b>
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
                            <a href="{{ route('admin.usuarios.crear') }}" class="btn btn-primary">Crear alumno</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-2">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped text-center">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>ID</th>
                                            <th>NAME</th>
                                            <th>EMAIL</th>
                                            <th>TIPO</th>
                                            <th>FECHA</th>
                                            <th>ESTADO</th>
                                            <th>OPTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($comisiones->count())
                                            @foreach ($comisiones as $item)
                                                <tr>
                                                    <td>{{ $item->vendedor->id }}</td>
                                                    <td>{{ $item->cartera->alumnos->name }}</td>
                                                    <td>{{ $item->cartera->alumnos->email }}</td>
                                                    <td>{{ $item->tipos->name }}</td>
                                                    <td>{{ $item->cartera->fecha }}</td>
                                                    <td>
                                                        @if ($item->cartera->estado == 'pagado')
                                                            <span class="badge text-bg-success">Pagado</span>
                                                        @else
                                                            <span class="badge text-bg-danger">Pendiente</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a class="dropdown-item "
                                                            href="{{ route('admin.usuarios.show', $item->cartera->alumnos->id) }}"
                                                            type="button"><i class="fa-solid fa-pen-to-square "></i>
                                                            Editar</a>
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
                                        {{ $comisiones->links() }}
                                    </div>
                                    <div class="col-md-6">
                                        <div class="float-end">
                                            Mostrando {{ $comisiones->firstItem() }} a {{ $comisiones->lastItem() }}
                                            del total de {{ $comisiones->total() }} registros
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
