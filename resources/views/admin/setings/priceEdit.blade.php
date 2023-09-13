<div wire:ignore.self class="modal fade" id="editPrice" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" wire:submit.prevent='update'>
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar precio</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label for="">Nombre</label>
                    <input type="text" wire:model="name" class="form-control">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <label for="">Precio del curso</label>
                    <input type="text" wire:model="value" class="form-control">
                    @error('value')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
