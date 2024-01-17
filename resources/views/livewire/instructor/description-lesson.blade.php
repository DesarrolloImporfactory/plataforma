<section class="card rounded dark:bg-gray-200">
    <div x-data='{open : true}' class="py-3 px-3">
        <header x-on:click='open = !open'
            class="cursor-pointer font-bold text-xl text-gray-600 flex items-center justify-between">
            Enlaces de la lección
        </header>

        <div x-show='open'>
            @foreach ($lesson->enlaces as $item)
                <div class=" mt-4">
                    @if ($enlaces->id == $item->id)
                        <form action="" wire:submit.prevent='update'>
                            <x-input class="w-full mb-2" wire:model='enlaces.name' placeholder="descripción"></x-input>
                            <x-input-error for='enlaces.name' />
                            <x-input class="w-full mb-2" wire:model='enlaces.url'
                                placeholder="ingrese una dirección web"></x-input>
                            <x-input-error for='enlaces.url' />
                            <x-danger-button class="" type="submit">Guardar</x-danger-button>
                        </form>
                    @else
                        <div class="flex justify-between items-center">
                            <header class="">
                                <p>{{ $item->name }}: <a href="{{ $item->url }}" target="_back"
                                        class="text-blue-500 cursor-pointer">{{ $item->url }}</a></p>
                            </header>
                            <div>
                                <i wire:click='edit({{ $item }})'
                                    class="fa-solid fa-pen-to-square text-blue-500 cursor-pointer mr-2"></i>
                                <i wire:click="$emit('deleteEnlace',{{ $item->id }})"
                                    class="fa-solid fa-trash-can text-red-500 cursor-pointer"></i>
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
            <hr>
            <article class="dark:bg-gray-100 overflow-hidden shadow-lg rounded mt-4">
                <div class="px-4 py-2">
                    <form action="" wire:submit.prevent='store'>
                        <x-input class="w-full mt-2" wire:model='name'
                            placeholder="agregar el nombre de la meta"></x-input>
                        <x-input-error for='name' />
                        <x-input class="w-full mt-2" wire:model='url' placeholder="ingrese una dirección web"></x-input>
                        <x-input-error for='url' />
                        <div class="flex justify-end mt-5 gap-4">
                            <x-button>Guardar</x-button>
                        </div>
                    </form>
                </div>
            </article>
        </div>
    </div>
</section>
@push('js')
    <script>
        Livewire.on('deleteEnlace', sectionId => {
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
                    Livewire.emitTo('instructor.description-lesson', 'delete', sectionId);
                }
            })
        });
    </script>
@endpush
