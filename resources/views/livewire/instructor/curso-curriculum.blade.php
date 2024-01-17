<div>
    <x-slot name="curso">
        {{ $curso->id }}
    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('View course') }}
        </h2>
    </x-slot>
    <div class="flex items-center p-4  text-sm @switch($curso->status)
        @case(1)
        text-gray-800 bg-gray-50 dark:bg-gray-800 dark:text-gray-400
            @break
        @case(2)
        text-yellow-800 bg-yellow-50 dark:bg-gray-800 dark:text-yellow-400
            @break
            @case(3)
            text-green-800 bg-green-50 dark:bg-gray-800 dark:text-green-400
            @break
        @default
            
    @endswitch  rounded-lg"
        role="alert">
        <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
            fill="currentColor" viewBox="0 0 20 20">
            <path
                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
        </svg>

        <span class="sr-only">Info</span>
        @switch($curso->status)
            @case(1)
                <div>
                    <span class="font-medium">Warning alert!</span> Este curso esta pendiente.
                </div>
            @break

            @case(2)
                <div>
                    <span class="font-medium">pending alert!</span> Este curso esta en revisión.
                </div>
            @break

            @case(3)
                <div>
                    <span class="font-medium">Success alert!</span> Este curso esta aprobado.
                </div>
            @break

            @default
        @endswitch
    </div>

    <div class="px-6 py-4 text-gray-600">
        <h1 class="text-2xl font-bold dark:text-white"><i class="fa-solid fa-circle-info mr-2"></i>LECCIONES DEL CURSO</h1>
        <hr class="mt-2 mb-6">
        @foreach ($curso->section as $item)
            <article x-data="{ open: true }" class="bg-white dark:bg-gray-900 overflow-hidden shadow-lg rounded mb-6">
                <div class="px-4 py-6">
                    @if ($item->id == $section->id)
                        <form wire:submit.prevent='update'>
                            <x-input class="w-full" placeholder="Ingrese el nombre de la sección."
                                wire:model='section.name'></x-input>
                            <x-input-error for='section.name' />
                        </form>
                    @else
                        <header class="flex justify-between items-center">
                            <h1 x-on:click="open = !open" class="cursor-pointer text-gray-400">
                                Sección:<strong>{{ $item->name }}</strong></h1>
                            <div>
                                <i class="mr-3 fa-solid fa-pen-nib cursor-pointer text-xl text-blue-500"
                                    wire:click='edit({{ $item }})'></i>
                                <i wire:click="$emit('deleteSection',{{ $item }})"
                                    class="fa-solid fa-delete-left cursor-pointer text-xl text-red-500"></i>
                            </div>
                        </header>
                        <div x-show="open">
                            @livewire('instructor.curso-leccion', ['section' => $item], key('section'.$item->id))
                        </div>
                    @endif
                </div>
            </article>
        @endforeach
        <div x-data="{ open: false }">
            <a x-show="!open" x-on:click="open = true" class="ml-1 items-center flex cursor-pointer text-white"><i
                    class="fa-regular fa-square-plus mr-3 text-2xl text-red-500"></i>Agregar lección.</a>
            <article x-show="open" class="card dark:bg-gray-900 rounded mb-6 mt-5">
                <div class="px-4 py-6">
                    <h1 class="card-title">Agregar sección.</h1>
                    <hr>
                    <form wire:submit.prevent="create" class="mt-6">
                        <x-input class="w-full" placeholder="Ingrese el nombre de la sección."
                            wire:model='name'></x-input>
                        <x-input-error for='name' />
                        <div class="flex justify-end mt-5 gap-4">
                            <x-danger-button x-on:click="open = false">Cancelar</x-danger-button>
                            <x-button>Guardar</x-button>
                        </div>
                    </form>
                </div>
            </article>
        </div>
    </div>
</div>

@push('js')
    <script>
        Livewire.on('deleteSection', sectionId => {
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
                    Livewire.emitTo('instructor.curso-curriculum', 'delete', sectionId);
                }
            })
        });
    </script>
@endpush
