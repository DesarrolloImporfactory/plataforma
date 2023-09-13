<div>
    <article class="card rounded dark:bg-gray-300">
        <div x-data="{ open: false }" class="py-3 px-3">
            <header x-on:click="open = !open"
                class="cursor-pointer font-bold text-xl text-gray-600 flex items-center justify-between">Recursos de la
                lección <i class="fa-solid fa-chevron-down"></i></header>
            <div x-show="open">
                <hr class="my-2">
                @if ($lesson->resource)
                    <div class="flex justify-between items-center">
                        <p class="text-blue-500 text-sm"><i wire:click='download' class="fa-solid fa-cloud-arrow-down mr-2 cursor-pointer text-gray-700 text-xl"></i>{{$lesson->resource->url}}</p>
                        <i wire:click="$emit('deleteRecurso',{{$lesson->resource}})" class="fa-solid fa-trash-can text-red-500 cursor-pointer text-xl"></i>
                    </div>
                @else
                    <form id="update" action="" wire:submit.prevent='save'>
                        <div class="flex items-center gap-2">
                            <input wire:model='file'
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                id="file_input" type="file">


                            <button class="btn btn-primary font-semibold text-xs"
                                wire:loading.attr="disabled">AGREGAR</button>
                        </div>
                        <div wire:loading wire:target='file' class="text-blue-500 font-bold">
                            Cargando....
                        </div>
                        <x-input-error for='file' />
                    </form>
                @endif
            </div>
        </div>
    </article>
</div>
@push('js')
    <script>
        Livewire.on('deleteRecurso',url=> {
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
                    Livewire.emitTo('instructor.lesson-resources', 'eliminar',url);
                }
            })
        });
    </script>
@endpush
