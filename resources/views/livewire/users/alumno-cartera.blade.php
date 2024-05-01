<div class="bg-white shadow-lg">
    <div class="py-4 px-4">
        <div class="d-flex px-2">
            <div class="flex-grow-1">
                <h4><a wire:click="$emit('deleteCartera',{{ $cartera->id }})" class="btn"><i class="fa-regular fa-trash-can text-danger"></i></a>Deuda: USD {{ $cartera->saldo }}$</h4>
                <span>{{$cartera->detalle}}</span>
            </div>
            <div class="float-end">
                @if ($cartera->estado == 'pendiente')
                    <h5><span class="badge  text-bg-danger">{{ $cartera->estado }}</span></h5>
                @endif
                @if ($cartera->estado == 'pagando')
                    <h5><span class="badge  text-bg-warning">{{ $cartera->estado }}....</span></h5>
                @endif
                @if ($cartera->estado == 'pagado')
                    <h5><span class="badge  text-bg-success">{{ $cartera->estado }}!!</span></h5>
                @endif
            </div>
        </div>
        <hr>
        <div class="shadow rounded">
            <div class="px-3 py-2">
                <div class="d-flex">
                    <h5>Listado de pagos</h5>
                </div>
                <hr>
                @foreach ($cartera->abonos as $item)
                    @livewire('users.pagos-cartera', ['abono' => $item], key('pago' . $item->id))
                @endforeach
                <div x-data="{ open: false }">
                    <a x-show="!open" x-on:click="open = true" class="btn btn-lg"><i
                            class="fa-regular fa-square-plus mr-3 text-danger"></i>Agregar pagos.</a>
                    <div x-show="open" class="card bg-light">
                        <div class="card-body">
                            <div class="mb-4">
                                <h5 class="">Agregar pagos.</h5>
                            </div>
                            <hr>
                            <form wire:submit.prevent="create" class="row mt-6">
                                <div class="col-md-6 form-group mt-2">
                                    <p>Valor</p>
                                    <input class="form-control" wire:model='valor'
                                        placeholder="Ingrese el valor del pago">
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
                                <p>Subir comprobante de pago</p>
                                <input type="file" class="form-control" wire:model='file'>
                                @error('file')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <div class="flex justify-end mt-2">
                                    <button type="button" class="btn btn-secondary"
                                        x-on:click="open = false">Cancelar</button>
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script>
        Livewire.on('deleteAbono', sectionId => {
            Swal.fire({
                title: 'Segur@ deseas eliminar el pago?',
                text: "Puede tener registros asociados!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Elimina esto!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emitTo('users.alumno-cartera', 'delete', sectionId);
                }
            })
        });
        Livewire.on('deleteCartera', sectionId => {
            Swal.fire({
                title: 'Segur@ deseas eliminar el pago?',
                text: "Puede tener registros asociados!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Elimina esto!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emitTo('users.user-cartera', 'destroy', sectionId);
                }
            })
        });
    </script>
@endpush
