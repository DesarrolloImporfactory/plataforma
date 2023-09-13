<div>
    @foreach ($section->lesson as $item)
        <article x-data="{ open: false }" class="bg-white dark:bg-gray-400 rounded overflow-hidden shadow-lg mt-4">
            <div class="px-4 py-4">
                @if ($item->id == $lesson->id)
                    <form action="" wire:submit.prevent='update'>
                        <div class="mb-3">
                            <label for="">Nombre:</label>
                            <x-input class="w-full" placeholder="Ingrese el nombre de la lección."
                                wire:model='lesson.name'></x-input>
                            <x-input-error for='lesson.name' />
                        </div>
                        <div class="mb-3">
                            <label for="">URL:</label>
                            <x-input class="w-full" placeholder="" wire:model='lesson.url'></x-input>
                            <x-input-error for='lesson.url' />
                        </div>
                        <div class="mb-3">
                            <label for="">Plataforma:</label>
                            <select wire:model='lesson.platform_id' id="countries"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @foreach ($platform as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error for='lesson.platform_id' />
                        </div>
                        <div class="flex justify-end gap-2">
                            <x-danger-button wire:click='cancel'>Cancelar</x-danger-button>
                            <x-button>Guardar</x-button>
                        </div>
                    </form>
                @else
                    <header x-on:click="open = !open" class="cursor-pointer">
                        <h1><i class="fa-regular fa-circle-play mr-3 text-blue-500"></i>Lección: {{ $item->name }}
                        </h1>
                    </header>
                    <div x-show="open">
                        <hr class="my-2">
                        <p class="text-sm">Plataforma: {{ $item->platform->name }}</p>
                        <p class="text-sm">Enlace: <a class="text-blue-500" href="{{ $item->url }}"
                                target="_black">{{ $item->url }}</a></p>
                        <div class="flex mt-2 gap-2">
                            <x-danger-button
                                wire:click="$emit('deleteLeccion',{{ $item->id }})">Eliminar</x-danger-button>
                            <x-button wire:click='edit({{ $item }})'>Editar</x-button>
                        </div>
                        <div class="my-2">
                            @livewire('instructor.lesson-description', ['lesson' => $item], key('lesson-description'.$item->id))
                        </div>
                        <div class="my-2">
                            @livewire('instructor.lesson-resources', ['lesson' => $item], key('lesson-resources'.$item->id))
                        </div>
                    </div>
                @endif
            </div>
        </article>
    @endforeach
    <div x-data="{ open: false }" class="mt-4">
        <a x-show="!open" x-on:click="open = true" class="ml-1 items-center flex cursor-pointer text-white"><i
                class="fa-regular fa-square-plus mr-3 text-2xl text-red-500"></i>Agregar lección.</a>
        <article x-show="open" class="card dark:bg-gray-400 rounded mb-6 mt-5">
            <div class="px-4 py-2">
                <h1 class="card-title">Agregar lección.</h1>
                <hr>
                <form action="" wire:submit.prevent='create' class="mt-4">
                    <div class="mb-3">
                        <label for="">Nombre:</label>
                        <x-input class="w-full" placeholder="Ingrese el nombre de la lección."
                            wire:model='name'></x-input>
                        <x-input-error for='name' />
                    </div>
                    <div class="mb-3">
                        <label for="">URL:</label>
                        <x-input class="w-full" placeholder="" wire:model='url'></x-input>
                        <x-input-error for='url' />
                    </div>
                    <div class="mb-3">
                        <label for="">Plataforma:</label>
                        <select wire:model='platform_id' id="countries"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @foreach ($platform as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error for='platform_id' />
                    </div>
                    <div class="flex justify-end gap-2">
                        <x-danger-button x-on:click="open = false">Cancelar</x-danger-button>
                        <x-button>Guardar</x-button>
                    </div>
                </form>
            </div>
        </article>
    </div>
</div>
@push('js')
    <script>
        Livewire.on('deleteLeccion', sectionId => {
            Swal.fire({
                title: 'Segur@ deseas eliminar el registro?',
                text: "Puede tener registros asociados!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Elimina esto!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emitTo('instructor.curso-leccion', 'delete', sectionId);
                }
            })
        });
    </script>
@endpush
