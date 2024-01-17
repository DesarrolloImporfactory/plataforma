<div wire:ignore.self class="modal fade" id="comisionesModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tipos de comisiones</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form wire:submit.prevent='createComision'>
                    <div class="row">
                        <div class="col">
                            <p>Nombre de la comisión:</p>
                            <input type="text" class="form-control" wire:model="comision">
                            @error('comision')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col">
                            <p>Valor:</p>
                            <input type="text" class="form-control" wire:model="valor">
                            @error('valor')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block mt-2">Guardar</button>
                </form>
                @if ($comisionesTipo == '0')
                    <div class="alert alert-light mt-2">
                        No existen registros
                    </div>
                @else
                    <table class="table table-bordered table-sm text-center mt-2">
                        <thead class="">
                            <tr>
                                <th>TIPO</th>
                                <th>VALOR</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($comisionesTipo as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->valor }}%</td>
                                    <td><a class="btn" wire:click='trash({{ $item->id }})'><i
                                                class="fa-regular fa-trash-can"></i></a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>

            </div>

        </div>
    </div>

</div>
