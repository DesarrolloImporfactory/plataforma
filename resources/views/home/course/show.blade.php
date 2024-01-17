<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Course') }}
        </h2>
    </x-slot>

    <section class="mt-19  overflow-hidden py-8">
        <div class="container grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
            <figure>
                <img class="h-80 w-full object-cover" src="{{ Storage::url($curso->image->url) }}" alt="">
            </figure>
            <div class="text-gray-800 dark:text-gray-200">
                <h1 class="text-4xl text-center">{{ $curso->title }}</h1>
                <h2 class="text-xl mt-4">{{ $curso->subtitle }}</h2>
                <p class="mt-3"><i class="fa-solid fa-chart-line mr-3"></i>Nivel: {{ $curso->level->name }}</p>
                <p class="mt-3"><i class="fa-solid fa-bars mr-3"></i>Categoria: {{ $curso->categorie->name }}</p>
                <p class="mt-3"><i class="fa-solid fa-users mr-3"></i>Matriculados: {{ $curso->students_count }}</p>
                <p class="mt-3"><i class="fa-solid fa-star text-yellow-400 mr-3"></i>Calificación:
                    {{ $curso->rating }}</p>
            </div>
        </div>
    </section>
    <div class="container grid grid-cols-1 lg:grid-cols-3 py-6 gap-6">
        <div class="order-2 lg:col-span-2 lg:order-1">
            <h2 class="text-gray-800 dark:text-gray-200 text-2xl"><i class="fa-solid fa-bullseye"></i> Metas del curso
            </h2>
            <section class="card rounded">
                <div class="flex mt-3 mb-3">
                    <ul class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-2 px-4">
                        @if ($curso->goal->count())
                            @foreach ($curso->goal as $goal)
                                <li class="text-gray-400 text-base"><i
                                        class="fa-regular fa-flag mr-2 text-gray-600"></i>{{ $goal->name }}</li>
                            @endforeach
                        @else
                            <li class="text-gray-400 text-base"><i
                                    class="fa-regular fa-flag mr-2 text-gray-600"></i>Descripción pendiente</li>
                        @endif
                    </ul>
                </div>
            </section>
            <h2 class="text-gray-800 dark:text-gray-200 text-2xl mt-6"><i class="fa-solid fa-book-open"></i> Temario del
                curso</h2>
            <section class="mt-1">
                @foreach ($curso->section as $section)
                    <article class="mb-4 shadow "
                        @if ($loop->first) x-data="{open : true}"
                    @else
                    x-data="{open : false}" @endif>
                        <header x-on:click="open = !open"
                            class="rounded dark:border-gray-600 bg-white dark:bg-gray-700  px-4 py-4 cursor-pointer flex items-center justify-between">
                            <h1 class="font-bold text-lg text-gray-800 dark:text-gray-200">{{ $section->name }}</h1>
                            <p class="ml-2 dark:text-gray-300">{{ $section->lesson->count() }} Clases</p>
                        </header>
                        <hr>
                        <div class="border-gray-600 bg-gray-300 dark:bg-gray-800 sm:rounded-b-lg py-2 px-4"
                            x-show="open">
                            <ul class="grid grid-cols-1 gap-2">
                                @if ($section->lesson->count())
                                    @foreach ($section->lesson as $lessons)
                                        <li class="text-gray-400 text-base"><i
                                                class="fa-regular fa-circle-play mr-2 text-gray-600"></i>{{ $lessons->name }}
                                        </li>
                                    @endforeach
                                @else
                                    <li class="text-gray-400 text-base"><i
                                            class="fa-regular fa-circle-play mr-2 text-gray-600"></i>Temario pendiente
                                    </li>
                                @endif

                            </ul>
                        </div>

                    </article>
                @endforeach
            </section>
            <h2 class="text-gray-800 dark:text-gray-200 text-2xl mt-6">Requisitos del curso</h2>
            <section class="card rounded">
                <ul class="list-disc list-inside grid grid-cols-1 gap-2 p-4">
                    @if ($curso->requirement->count())
                        @foreach ($curso->requirement as $requirement)
                            <li class="text-gray-400 text-base">{{ $requirement->name }}</li>
                        @endforeach
                    @else
                        <li class="text-gray-400 text-base">Requisitos pendientes</li>
                    @endif
                </ul>
            </section>
            <h2 class="text-gray-800 dark:text-gray-200 text-2xl mt-6">Descripción del curso</h2>
            <section class="text-gray-700 dark:text-gray-400 text-base mt-4">
                {!! $curso->description !!}
            </section>
            {{-- reseñas del curso --}}
            {{-- @livewire('course.course-reviews', ['curso' => $curso]) --}}
        </div>
        <div class="order-1 lg:order-2">
            <section class="card mt-8 rounded">
                <div class="px-6 py-4">
                    <div class="flex items-center ">
                        <img class="h-13 w-13 object-cover rounded-full shadow-lg"
                            src="{{ $curso->teacher->profile_photo_url }}" alt="{{ $curso->teacher->name }}">
                        <div class="ml-4">
                            <h1 class="font-bold text-gray-700 text-lg dark:text-gray-200">Autor.
                                {{ $curso->teacher->name }}</h1>
                            <a
                                class="text-blue-400 text-sm font-bold">{{ '@' . Str::slug($curso->teacher->name, '') }}</a>
                        </div>
                    </div>
                    @can('userCourse', $curso)
                        <form action="{{ route('cursos.enrolled', $curso) }}" method="post">
                            @csrf
                            <x-danger-button type="submit" class="mt-6 btn-block">CONTINUAR CON EL CURSO</x-danger-button>
                        </form>
                    @else
                        <x-danger-button class="mt-6 btn-block">CURSO NO ADQUIRIDO</x-danger-button>
                        {{-- <form action="{{ route('cursos.enrolled', $curso) }}" method="post">
                            @csrf
                            <x-danger-button type="submit" class="mt-6 btn-block">CURSO NO ADQUIRIDO</x-danger-button>
                        </form> --}}
                    @endcan
                </div>
            </section>
            <aside class="mt-5 hidden lg:block">
                @foreach ($similares as $similar)
                    <article class="flex mb-6">
                        <img class="h-32 w-40 object-cover" src="{{ Storage::url($similar->image->url) }}"
                            alt="">
                        <div class="ml-3">
                            <h1>
                                <a href="{{ route('cursos.show', $similar) }}"
                                    class="font-bold text-gray-700  dark:text-gray-200 mb-3">{{ Str::limit($similar->title, 40) }}</a>
                            </h1>
                            <div class="flex items-center mt-3">
                                <img class="h-8 w-8 object-cover rounded-full shadow-lg"
                                    src="{{ $similar->teacher->profile_photo_url }}" alt="">
                                <p class="font-bold text-gray-500 ml-3 text-sm">{{ $similar->teacher->name }}</p>
                            </div>
                            <p class="text-gray-400 mt-3"><i
                                    class="fa-solid fa-star text-yellow-400 mr-3"></i>{{ $similar->rating }}</p>
                        </div>
                    </article>
                @endforeach
            </aside>
        </div>
    </div>

</x-app-layout>
