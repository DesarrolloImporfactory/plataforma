<div>
    <div x-data="{ open: false }" class="shadow bg-secondary-subtle rounded mb-3">
        <div class="px-3 py-2">
            @if ($editar == 'true')
                <div class="row mt-6">
                    <div class="col-md-6 form-group mt-2">
                        <p>Valor</p>
                        <input class="form-control" wire:model='valor' placeholder="Ingrese el valor del pago">
                        @error('valor')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group mt-2">
                        <p>Forma de pago</p>
                        <select name="" wire:model='forma_pago' class="form-select">
                            <option value="">Seleccionar.....</option>
                            @foreach ($formas as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('forma_pago')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p>Subir comprobante de pago</p>
                            <input type="file" class="form-control" wire:model='file'>
                        </div>
                        <div class="col-md-6">
                            @if ($abono->archivo)
                               <div class="alert alert-info mt-3">
                                Actualmente este pago ya tiene subido un comprobante de pago.
                               </div>
                            @endif
                        </div>
                    </div>
                    <div class="flex justify-end mt-2">
                        <button type="button" wire:click="$set('editar','false')"
                            class="btn btn-secondary btn-sm">Cancelar</button>
                        <button wire:click="update" wire:loading.attr='disabled' wire:target='file' class="btn btn-primary btn-sm">Actualizar</button>
                    </div>
                </div>
            @else
                <div x-on:click="open = !open" class="d-flex cursor-pointer">
                    <div class="flex-grow-1">
                        <h5><i class="fa-solid fa-circle-dollar-to-slot"></i> Pago de: USD
                            {{ $abono->valor }}$
                        </h5>
                    </div>
                    <div class="float-end">
                        {{ $abono->fecha }}
                    </div>
                </div>
                <div x-show="open" class="bg-light px-3">
                    <hr>
                    <p>Forma de pago: {{ $abono->forma->name }}</p>
                    @if ($abono->archivo)
                        <p>Visualizar archivo: 
                            <a class="text-primary" data-bs-toggle="modal"
                                data-bs-target="#exampleModal{{ $abono->id }}">Comprobante de pago <i class="fa-regular fa-file-lines"></i>
                            </a>
                        </p>
                        <div class="modal fade" id="exampleModal{{ $abono->id }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $abono->id }}"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel{{ $abono->id }}">Comprobante de pago</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <img src="{{ Storage::url($abono->archivo) }}" width="650px" alt="Imagen" />
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <p>Visualizar archivo: <span class="text-danger">No tiene comprobante</span></p>
                    @endif
                    <button wire:click="$set('editar','true')" class="btn btn-primary btn-sm">Editar</button>
                    <button wire:click="$emit('deleteAbono',{{ $abono->id }})"
                        class="btn btn-danger btn-sm">Eliminar</button>
                </div>
            @endif
        </div>
    </div>
</div>
