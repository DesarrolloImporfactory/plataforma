<div>
    <article class="card rounded dark:bg-gray-200">
        <div x-data="{ open: false }" class="py-3 px-3">
            <header x-on:click="open = !open"
                class="cursor-pointer font-bold text-xl text-gray-600 flex items-center justify-between">Descripcion de
                la lección <i class="fa-solid fa-chevron-down"></i></header>
            <div x-show="open">
                <hr class="my-2">
                @if ($lesson->description)
                    <form id="update" action="" wire:submit.prevent='update'>
                        <label for="">Nombre:</label>
                        <textarea name="" wire:model='description.name' class="form-input w-full rounded" id="" cols="30"
                            rows="3"></textarea>
                        <x-input-error for='description.name' />
                        <div class="flex justify-end gap-2 py-2">
                            <x-danger-button wire:click="delete">Eliminar</x-danger-button>
                            <button class="btn btn-primary font-semibold text-xs">ACTUALIZAR</button>
                        </div>
                    </form>
                @else
                    <form id="create" action="" wire:submit.prevent='create'>
                        <label for="">Nombre:</label>
                        <textarea name="" wire:model='name' class="form-input w-full rounded" id="" cols="30"
                            rows="3"></textarea>
                        <x-input-error for='name' />
                        <div class="flex justify-end gap-2 py-2">
                            <button class="btn btn-primary font-semibold text-xs">AGREGAR</button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </article>
</div>
{{-- @push('js')
    <script>
        Livewire.on('deleteDescription', sectionId => {
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
                    Livewire.emitTo('instructor.lesson-description', 'eliminar', sectionId);
                }
            })
        });
    </script>
@endpush --}}
