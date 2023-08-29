<div class="py-10">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Course') }}
        </h2>
    </x-slot>
    <div class="container grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class=" lg:col-span-2">
            <div class="embed-responsive">
                {!! $current->iframe !!}
            </div>
            <section class="mt-6">
                <h1 class="font-bold text-gray-700  text-xl dark:text-gray-200">{{ $current->name }}</h1>
                <div class="card rounded">
                    <div class="text-gray-400 text-base py-2 px-4">
                        {{ $current->description->name }}
                    </div>
                </div>
            </section>
            <div class="mt-4 flex items-center cursor-pointer" wire:click='stateLesson'>
                @if ($current->completed)
                    <i class="fa-solid fa-toggle-on text-blue-700  dark:text-blue-400 mr-3 text-2xl"></i>
                @else
                    <i class="fa-solid fa-toggle-off text-blue-700  dark:text-blue-400 mr-3 text-2xl"></i>
                @endif
                <p class="text-gray-700  text-lg dark:text-gray-200">Marcar esta clase como terminada 
                </p>
            </div>
            <section class="card rounded mt-6">
                <div class="px-6 py-4">
                    <div class="flex text-gray-400 font-bold">
                        @if ($this->previous)
                            <a wire:click='changeLesson({{ $this->previous }})' class="cursor-pointer"><i
                                    class="fa-solid fa-angles-left mr-2"></i>Tema anterior</a>
                        @else
                            <p>Tema de inicio</p>
                        @endif
                        @if ($this->next)
                            <a wire:click='changeLesson({{ $this->next }})' class="cursor-pointer ml-auto">Siguiente
                                tema<i class="fa-solid fa-angles-right ml-2"></i></a>
                        @else
                            <a class="cursor-pointer ml-auto">Fin de curso</a>
                        @endif
                    </div>
                </div>
            </section>
        </div>
        <div class="card rounded">

            <div class="px-6 py-4">
                <h1 class="card-title leading-8 text-center text-2xl">{{ $curso->title }}</h1>
                <div class="flex items-center mt-4 mb-4">
                    <img class="h-13 w-13 object-cover rounded-full shadow-lg"
                        src="{{ $curso->teacher->profile_photo_url }}" alt="{{ $curso->teacher->name }}">
                    <div class="ml-4">
                        <h1 class="font-bold text-gray-700 text-sm text-lg dark:text-gray-200">Prof.
                            {{ $curso->teacher->name }}</h1>
                        <a class="text-blue-400 text-sm font-bold">{{ '@' . Str::slug($curso->teacher->name, '') }}</a>
                    </div>
                </div>
                <p class="text-gray-700 text-sm  dark:text-gray-200">{{$this->advance.'%'}} Completado</p>
                <div class="relative pt-1">
                    <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-red-200">
                        <div style="width:{{$this->advance.'%'}}"
                            class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-red-500 transition-all duration-500">
                        </div>
                    </div>
                </div>
                <ul>
                    @foreach ($curso->section as $section)
                        <li class="mb-4">
                            <a class="text-gray-200 font-bold inline-block mb-2">{{ $section->name }}</a>
                            <ul>
                                @foreach ($section->lesson as $lesson)
                                    <li class="flex mb-1">
                                        <div>
                                            @if ($lesson->completed)
                                                @if ($current->id == $lesson->id)
                                                    <span
                                                        class="inline-block w-4 h-4 border-2 border-green-400 rounded-full mr-2 mt-1"></span>
                                                @else
                                                    <span
                                                        class="inline-block w-4 h-4 bg-yellow-400 rounded-full mr-2 mt-1"></span>
                                                @endif
                                            @else
                                                @if ($current->id == $lesson->id)
                                                    <span
                                                        class="inline-block w-4 h-4 border-2 border-green-500 rounded-full mr-2 mt-1"></span>
                                                @else
                                                    <span
                                                        class="inline-block w-4 h-4 bg-gray-500 rounded-full mr-2 mt-1"></span>
                                                @endif
                                            @endif
                                        </div>
                                        <a wire:click='changeLesson({{ $lesson }})'
                                            class=" text-base cursor-pointer {{ $current->id == $lesson->id ? 'text-gray-200' : 'text-gray-400 text-sm' }}">{{ $lesson->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
