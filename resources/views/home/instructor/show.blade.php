<x-instructor-layout>
    <x-slot name="curso">
        {{ $curso }}
    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('View course') }}
        </h2>
    </x-slot>

   

        @livewire('instructor.update-curso', ['curso' => $curso], key($curso->id))
   

</x-instructor-layout>
