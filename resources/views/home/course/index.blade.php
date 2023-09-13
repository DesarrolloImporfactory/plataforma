<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Courses') }}
        </h2>
    </x-slot>

    <section class="bg-cover shadow-xl" style="background-image: url({{ asset('img/home/home.jpg') }})">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-36">
            <div class="w-full md:w-3/4 lg:w-1/2">
                <h1 class="text-white font-fold text-4xl">MIRA NUESTROS CURSOS!</h1>
                <p class="text-white text-lg mt-2 mb-4">Descubre y aprende los mejores cursos de importación.</p>
            </div>
        </div>
    </section>

    @livewire('course.course-index')
</x-app-layout>
