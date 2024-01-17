<section x-data='{open : true}'>
    <header x-on:click='open = !open' class="bg-gray-200 dark:bg-gray-800 shadow-lg rounded py-4 px-4 cursor-pointer">
        <h1 class="text-2xl fond-bold dark:text-white">Requerimientos del curso</h1>
    </header>

    <article x-show='open' class="bg-white dark:bg-gray-200 overflow-hidden shadow-lg rounded mb-6">
        @foreach ($curso->requirement as $item)
            <div class="p-4 ">
                @if ($requirement->id == $item->id)
                    <form action="" wire:submit.prevent='update'>
                        <x-input class="w-full" wire:model='requirement.name'></x-input>
                        <x-input-error for='requirement.name' />
                    </form>
                @else
                    <div class="flex justify-between items-center">
                        <header class="">{{ $item->name }}</header>
                        <div>
                            <i wire:click='edit({{ $item }})'
                                class="fa-solid fa-pen-to-square text-blue-500 cursor-pointer mr-2"></i>
                            <i wire:click="$emit('deleteRequerimiento',{{ $item }})"
                                class="fa-solid fa-trash-can text-red-500 cursor-pointer"></i>
                        </div>
                    </div>
                @endif
            </div>
        @endforeach
    </article>
    <article class="dark:bg-gray-100 overflow-hidden shadow-lg rounded mb-6">
        <div class="p-4">
            <form action="" wire:submit.prevent='store'>
                <label for="">Nombre:</label>
                <x-input class="w-full mt-2" wire:model='name'
                    placeholder="agregar el nombre del requerimiento"></x-input>
                <x-input-error for='name' />
                <div class="flex justify-end mt-5 gap-4">
                    <x-danger-button>Cancelar</x-danger-button>
                    <x-button>Guardar</x-button>
                </div>
            </form>
        </div>

    </article>
</section>
@push('js')
    <script>
        Livewire.on('deleteRequerimiento', sectionId => {
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
                    Livewire.emitTo('instructor.curso-requerimientos', 'delete', sectionId);
                }
            })
        });
    </script>
@endpush
