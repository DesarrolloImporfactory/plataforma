<x-instructor-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('View Observations') }}
        </h2>
    </x-slot>
    <x-slot name="curso">
        {{ $curso->id }}
    </x-slot>

    <section class="py-6 px-4">
        <h1 class="text-2xl fond-bold text-white">Observaciones del curso</h1>
        <hr class="py-2">
            <article class="bg-white dark:bg-gray-200 overflow-hidden shadow-lg rounded mb-6">
                <div class="p-4 ">
                    {!!$curso->observation->body!!}
                </div>
            </article>
        
    </section>



</x-instructor-layout>
