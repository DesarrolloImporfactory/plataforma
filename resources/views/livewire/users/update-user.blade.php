<div>
    <div class="card">
        <div class="card-body">
            @if ($editar == 'true')
                <div class="shadow">
                    <form wire:submit.prevent='updateUser'>
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
                                    <p>Telefono:</p>
                                    <input type="text" class="form-control" wire:model='telefono'>
                                    @error('telefono')
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
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" wire:click="$set('editar','false')"
                                data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            @else
                <div class="shadow rounded">
                    <div class="px-3 py-2">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <h5><i class="fa-solid fa-user-graduate"></i> Alumno: {{ $name }}</h5>
                            </div>
                            <div class="float-end">
                                <button type="button" wire:click="$set('editar','true')"
                                    class="btn btn-secondary float-end" data-bs-dismiss="modal">Editar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <p>Email: <span class="text-primary">{{ $email }}</span>
                <p>
            @endif
            <hr>
            @if ($cartera == 'true')
                @livewire('users.user-cartera', ['user' => $user], key('deuda' . $user->id))
            @else
                <div class="shadow bg-light rounded">
                    <div class="px-2 py-4 d-flex">
                        <div class="flex-grow-1">
                            <h5>Este usuario no tiene una cartera habilitada, si desea puede habilitar la cartera
                                haciendo click en el siguiente enlace. <a class="btn text-primary"
                                    wire:click='createCartera'>click para crear
                                    cartera</a></h5>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
