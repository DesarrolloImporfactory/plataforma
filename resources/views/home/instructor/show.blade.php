<x-instructor-layout>
    <x-slot name=curso>
        {{$curso}}
    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('View course') }}
        </h2>
    </x-slot>

    <div class="px-6 py-4 text-gray-600">
        <h1 class="text-2xl font-bold text-white"><i
                class="fa-solid fa-circle-info mr-2"></i>INFORMACIÓN DEL CURSO</h1>
        <hr class="mt-2 mb-6">
        @livewire('instructor.update-curso', ['curso' => $curso], key($curso->id))
    </div>

</x-instructor-layout>
