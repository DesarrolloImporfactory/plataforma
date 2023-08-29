<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <section class="bg-cover shadow-xl" style="background-image: url({{ asset('img/home/home.jpg') }})">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-36">
            <div class="w-full md:w-3/4 lg:w-1/2">
                <h1 class="text-white font-fold text-4xl">APRENDE A IMPORTAR</h1>
                <p class="text-white text-lg mt-2 mb-4">Descubre y aprende los mejores cursos de importación.</p>
                <!-- component -->
                <!-- This is an example component -->
                @livewire('course.search-course')
            </div>
        </div>
    </section>

    <section class="mt-18 py-6">
        <h1 class="text-gray-600 text-center text-3xl mb-6">CONTENIDO</h1>
        <div
            class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-x-6 gap-y-8">
            <article>
                <figure>
                    <img class="rounded-xl h-36 w-full object-cover"
                        src="{{ asset('img/home/container-ship-596083_1280.jpg') }}" alt="">
                </figure>
                <header class="mt-2">
                    <h1 class="text-center text-xl text-gray-700">Curso y proyectos</h1>
                </header>
                <p class="text-sm text-gray-500 text-justify ">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Excepturi
                    autem totam nesciunt et, ipsam obcaecati praesentium necessitatibus inventore, fugiat ipsa
                    asperiores illo.</p>
            </article>
            <article>
                <figure>
                    <img class="rounded-xl h-36 w-full object-cover" src="{{ asset('img/home/port-1845350_1280.jpg') }}"
                        alt="">
                </figure>
                <header class="mt-2">
                    <h1 class="text-center text-xl text-gray-700">Manual </h1>
                </header>
                <p class="text-sm text-gray-500 text-justify">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Excepturi
                    autem totam nesciunt et, ipsam obcaecati praesentium necessitatibus inventore, fugiat ipsa
                    asperiores illo.</p>
            </article>
            <article>
                <figure>
                    <img class="rounded-xl h-36 w-full object-cover" src="{{ asset('img/home/port-6670684_1280.jpg') }}"
                        alt="">
                </figure>
                <header class="mt-2">
                    <h1 class="text-center text-xl text-gray-700">Blog</h1>
                </header>
                <p class="text-sm text-gray-500 text-justify">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Excepturi
                    autem totam nesciunt et, ipsam obcaecati praesentium necessitatibus inventore, fugiat ipsa
                    asperiores illo.</p>
            </article>
            <article>
                <figure>
                    <img class="rounded-xl h-36 w-full object-cover" src="{{ asset('img/home/ship-6282376_1280.jpg') }}"
                        alt="">
                </figure>
                <header class="mt-2">
                    <h1 class="text-center text-xl text-gray-700">Importaciones</h1>
                </header>
                <p class="text-sm text-gray-500 text-justify">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Excepturi
                    autem totam nesciunt et, ipsam obcaecati praesentium necessitatibus inventore, fugiat ipsa
                    asperiores illo.</p>
            </article>
        </div>
    </section>

    <section class="mt-24 bg-white dark:bg-gray-800 overflow-hidden shadow-xl py-12">
        <h1 class="text-white text-center text-3xl">¿No sabes que curso llevar?</h1>
        <p class="text-white text-center mt-8">Dirigete al catalogo de cursos y filtralos por categoria o nivel.</p>
        <div class="flex justify-center mt-6">
            <a href="{{ route('cursos.index') }}" class="btn btn-danger">
                Catalogo de cursos
            </a>
        </div>
    </section>

    <section class="my-20 py-2">
        <h1 class="text-gray-300 text-center text-3xl">ULTIMOS CURSOS</h1>
        <p class="text-center text-gray-500 text-sm mb-6 mt-6">Trabajando duro para seguir subiendo cursos
            constantemente.</p>
        <div class="container grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-x-6 gap-y-8 mt-6">
            @foreach ($cursos as $curso)
                <x-course-index :curso="$curso" />
            @endforeach
        </div>
    </section>

    <div class="py-12">
        <div class="container">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <x-welcome />
            </div>
        </div>
    </div>
</x-app-layout>
