<div>
    <div class="row">
        <div class="col-md-8">
            @foreach ($cartera as $item)
                @livewire('users.alumno-cartera', ['cartera' => $item], key('cartera' . $item->id))
            @endforeach
            <div class="mt-2">
                <div x-data="{ open: false }">
                    <a x-show="!open" x-on:click="open = true" class="btn btn-lg"><i
                            class="fa-regular fa-square-plus mr-3 text-danger"></i>Agregar deuda.</a>
                    <div x-show="open" class="card bg-light">
                        <div class="card-body">
                            <div class="mb-4">
                                <h5 class="">Agregar deuda</h5>
                            </div>
                            <hr>
                            <form wire:submit.prevent="save" class="row mt-6">
                                <div class="col-md-6 form-group mt-2">
                                    <p>Valor</p>
                                    <input class="form-control" wire:model='valor'
                                        placeholder="Ingrese el valor del pago">
                                    @error('valor')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 form-group mt-2">
                                    <p>Detalle</p>
                                    <input class="form-control" wire:model='detalle'
                                        placeholder="Ingrese el valor del pago">
                                    @error('detalle')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
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
        <div class="col-md-4">
            {{-- @livewire('users.status-deuda', ['deuda' => $cartera], key('deuda' . $cartera->id)) --}}
            <div class="shadow rounded">
                <div class="px-3 py-2">
                    @can('comisionista')
                        @if ($exist == 'false')
                            <h5>Comisión</h5>
                            <hr>
                            <form action="" wire:submit.prevent='create'>
                                <div class="form-group">
                                    <p>Seleccionar vendedor</p>
                                    <select name="" class="form-select" wire:change='getComision' wire:model='vendedor'
                                        id="">
                                        <option value="">Seleccionar....</option>
                                        @foreach ($vendedores as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('vendedor')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                @if ($tiposComision != '0')
                                    <div class="form-group">
                                        <p>Seleccionar comision</p>
                                        <select name="" class="form-select" wire:model='comision_tipo'
                                            id="">
                                            <option value="">Seleccionar....</option>
                                            @foreach ($tiposComision as $item)
                                                <option value="{{ $item->id }}">{{ $item->name.': '.$item->valor.'%'  }}</option>
                                            @endforeach
                                        </select>
                                        @error('vendedor')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                @endif
                                <hr>
                                <button type="submit" class="btn btn-primary">Asignar</button>
                            </form>
                        @else
                            @if ($editar == 'true')
                                <h5>Comisión</h5>
                                <hr>
                                <form action="" wire:submit.prevent='update'>
                                    <div class="form-group">
                                        <p>Seleccionar vendedor</p>
                                        <select name="" class="form-select" wire:change='getComision'
                                            wire:model='vendedor' id="">
                                            <option value="">Seleccionar....</option>
                                            @foreach ($vendedores as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('vendedor')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    @if ($tiposComision != '0')
                                        <div class="form-group">
                                            <p>Seleccionar comision</p>
                                            <select name="" class="form-select" wire:model='comision_tipo'
                                                id="">
                                                <option value="">Seleccionar....</option>
                                                @foreach ($tiposComision as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name.': '.$item->valor.'%' }}</option>
                                                @endforeach
                                            </select>
                                            @error('vendedor')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    @endif
                                    <hr>
                                    <button type="submit" class="btn btn-primary">Actualizar</button>
                                    <button type="button" class="btn btn-danger"
                                        wire:click="$set('editar','false')">Cancelar</button>
                                </form>
                            @else
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <h5>Comisión</h5>
                                    </div>
                                    <div class="float-end">
                                        @can('comisionista')
                                            <button class="btn btn-primary"
                                                wire:click="show({{ $comision }})">Editar</button>
                                        @endcan
                                    </div>
                                </div>
                                <hr>
                                <p>Vendedor: {{ $comision->vendedor->name }}</p>
                                <p>Tipo de comisión: {{ $comision->tipos->name }}</p>
                                <p>Valor de comisión: {{ $comision->tipos->valor }}%</p>
                            @endif
                        @endif
                    @endcan

                    @can('Asignar comision')
                        @if ($exist == 'false')
                            <h5>Comisión vendedor </h5>
                            <hr>
                            <form action="" wire:submit.prevent='createComision'>
                                <div class="form-group">
                                    <p>Seleccionar comisión</p>
                                    <select name="" class="form-select" wire:model='comision_id' id="">
                                        <option value="">Seleccionar....</option>
                                        @foreach ($comisiones as $item)
                                            <option value="{{ $item->id }}">
                                                {{ $item->name . ': ' . $item->valor . '%' }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('comision_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <hr>
                                <button type="submit" class="btn btn-primary">Asignar</button>
                            </form>
                        @else
                            @if ($editar == 'true')
                                <h5>Comisión</h5>
                                <hr>
                                <form action="" wire:submit.prevent='updateComision'>
                                    <div class="form-group">
                                        <p>Tipo de comisión</p>
                                        <select name="" class="form-select" wire:model='comision_id' id="">
                                            <option value="">Seleccionar....</option>
                                            @foreach ($comisiones as $item)
                                                <option value="{{ $item->id }}">
                                                    {{ $item->name . ': ' . $item->valor . '%' }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('comision_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <hr>
                                    <button type="submit" class="btn btn-primary">Actualizar</button>
                                    <button type="button" class="btn btn-danger"
                                        wire:click="$set('editar','false')">Cancelar</button>
                                </form>
                            @else
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <h5>Comisión</h5>
                                    </div>
                                    <div class="float-end">
                                        <button class="btn btn-primary" wire:click="show({{ $comision }})">Editar
                                        </button>
                                    </div>
                                </div>
                                <hr>
                                <p>Vendedor: {{ $comision->vendedor->name }}</p>
                                <p>Tipo de comisión: {{ $comision->tipos->name }}</p>
                                <p>Valor de comisión: {{ $comision->tipos->valor }}%</p>
                            @endif
                        @endif
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
