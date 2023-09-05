<div wire:ignore.self class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fa-solid fa-shield-halved"></i> Editar Rol</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent='update' action="">
                <div class="modal-body">

                    <div class="form-group">
                        <p>Nombre del rol:</p>
                        <input wire:model='name' class="form-control" type="text">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="alert alert-success text-center slim-alert">
                            <p class="mt-2"><i class="fa-solid fa-eye-slash"></i> Seleccionar permisos</p>
                        </div>
                        <div class="row">
                            @foreach (collect($permisos)->take(count($permisos) / 2) as $key => $item)
                                <div class="col-md-6">
                                    <div class="ml-3 mt-2 form-check">
                                        <input class="form-check-input" type="checkbox" wire:model="permissions" value="{{ $item->id }}">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{ $item->name }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <div class="row">
                            @foreach (collect($permisos)->skip(count($permisos) / 2) as $key => $item)
                                <div class="col-md-6">
                                    <div class="ml-3 mt-2 form-check">
                                        <input class="form-check-input" type="checkbox" wire:model="permissions" value="{{ $item->id }}">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{ $item->name }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Asignar</button>
                </div>
            </form>
        </div>
    </div>

</div>
