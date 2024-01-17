<div>
    @section('title', 'Create user')
    <div class="d-flex py-2">
        <h2>Alumno</h2>
    </div>

    <div class="card">
        <div class="card-body">
            <form wire:submit.prevent='createUser'>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <p>Nombre de usuario:</p>
                            <input type="text" class="form-control" wire:model="name">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <p>Email:</p>
                            <input type="text" class="form-control" wire:model="email">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <p>Password temporal:</p>
                            <input type="password" class="form-control" wire:model="password">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col form-group">
                            <p>Enlace:</p>
                            <input type="text" class="form-control" wire:model='enlace'>
                            @error('enlace')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <p>Asignar perfil:</p>
                            <select class="form-select" name="perfil" id="perfil" wire:model="perfil">
                                <option value="">Seleccione una opcion.....</option>
                                @foreach ($perfiles as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('perfil')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col">
                            <p>Telefono:</p>
                            <input type="text" class="form-control" wire:model='telefono'>
                            @error('telefono')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card" id="card">
        <div class="card-body">
            <h5 class="card-title">Formulario Bloqueado</h5>
            <form>
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" disabled>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" disabled>
                </div>
                <!-- Agrega más campos del formulario aquí -->
                <button type="submit" class="btn btn-primary" disabled>Enviar</button>
            </form>
        </div>
    </div>

    <style>
        #card {
            filter: blur(2px);
            /* Aplica un desenfoque al elemento card */
        }

        #card form * {
            pointer-events: none;
            /* Desactiva la interacción con elementos del formulario */
            opacity: 0.8;
            /* Reduce la opacidad para dar el efecto de desenfoque */
        }
    </style>
</div>
