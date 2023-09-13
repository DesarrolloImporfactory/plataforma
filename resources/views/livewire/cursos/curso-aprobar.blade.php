<div>
    <form action="" wire:submit.prevent='aprobar'>
        <x-danger-button type="submit" class="mt-6 btn-block">APROBAR ESTE CURSO</x-danger-button>
    </form>
    <div class="flex items-center">
        <a type="button"
            class="mt-4 flex-1 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
            href="{{ route('admin.cursos') }}">SALIR</a>
        <x-button class="mt-2 w-full items-center justify-center" wire:click="$set('open',true)">Observaciones</x-button>
    </div>
    <x-dialog-modal wire:model='open'>
        <x-slot name="title">
            Enviar observaciones
        </x-slot>

        <x-slot name="content">
            <form action="" wire:submit.prevent='observaciones' id="formulario">
                <div wire:ignore>
                    <x-label for="password">Observaciones del curso:</x-label>
                    <div class="w-full" id='observaciones'>
                        {!! $observaciones !!}
                    </div>
                </div>
                <x-input-error for='observaciones' />

            </form>
        </x-slot>
        <x-slot name="footer">
            <div class="flex justify-between gap-2">
                <x-button form="formulario">Enviar</x-button>
                <x-danger-button wire:click="$set('open',false)">Cancelar</x-danger-button>
            </div>
        </x-slot>

    </x-dialog-modal>
</div>
@push('js')
    <script>
        ClassicEditor
            .create(document.querySelector('#observaciones'), {
                toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote'],
                heading: {
                    options: [{
                            model: 'paragraph',
                            title: 'Paragraph',
                            class: 'ck-heading_paragraph'
                        },
                        {
                            model: 'heading1',
                            view: 'h1',
                            title: 'Heading 1',
                            class: 'ck-heading_heading1'
                        },
                        {
                            model: 'heading2',
                            view: 'h2',
                            title: 'Heading 2',
                            class: 'ck-heading_heading2'
                        }
                    ]
                }
            })
            .then(function(observaciones) {
                observaciones.model.document.on('change:data', () => {
                    @this.set('observaciones', observaciones.getData());
                })
            })
            .catch(error => {
                console.log(error);
            });
    </script>
@endpush
