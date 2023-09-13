<x-instructor-layout>
    <x-slot name="curso">
        {{ $curso->id }}
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
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('View goals') }}
        </h2>
    </x-slot>

    <div class="px-6 py-4 text-gray-600">
        <div class="py-2">
            @livewire('instructor.curso-metas', ['curso' => $curso], key('metas' . $curso->id))
        </div>
        <div class="py-2">
            @livewire('instructor.curso-requerimientos', ['curso' => $curso], key('requerimientos' . $curso->id))
        </div>
        <div class="py-2">
            @livewire('instructor.curso-audiencia', ['curso' => $curso], key('audiencia' . $curso->id))
        </div>
    </div>

</x-instructor-layout>
