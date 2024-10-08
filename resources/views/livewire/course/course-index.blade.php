<div>
    <div class="bg-white dark:bg-gray-800 shadow-xl py-4">
        <div class="container flex">
            <div class="grid lg:grid-cols-2 sm:grid-cols-1 md:grid-cols-2 gap-4">
                <div class="">
                    @livewire('course.search-course')
                </div>
                <div class="flex justify-between">
                    <button wire:click='resetFilters' class="bg-white shadow h-10 px-4 rounded-lg text-gray-700 mr-3">
                        <i class="fa-solid fa-bars text-xs mr-2"></i>
                        <span class="md:hidden lg:hidden" >Todos</span>
                    </button>
                    
                    <div x-data="{ open: false }" class="relative">
                        <button x-on:click="open = true"
                            class="inline-flex w-full relative z-10  bg-white p-2 focus:outline-none shadow h-10  rounded-lg text-gray-700 mr-3">
                            <i class="fa-solid fa-tags mr-2 p-1"></i>Categoria
                            <svg class="h-7 w-5 text-gray-800 ml-2" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div x-on:click.away="open = false" x-show="open"
                            class="absolute right-0 mt-2 py-2 w-48 bg-white rounded-md shadow-xl z-20">
                            @foreach ($categories as $item)
                                <a wire:click="$set('categorie_id',{{ $item->id }})" x-on:click="open = false"
                                    class="cursor-pointer block px-4 py-2 text-sm capitalize text-gray-700 hover:bg-blue-500 hover:text-white">
                                    {{ $item->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <div x-data="{ open: false }" class="relative">
                        <button x-on:click="open = true"
                            class="ml-3 inline-flex relative z-10  bg-white p-2 focus:outline-none shadow h-10  rounded-lg text-gray-700 mr-3">
                            <i class="fa-solid fa-list p-1 mr-2"></i>Niveles
                            <svg class="h-7 w-5 text-gray-800 ml-2" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div x-on:click.away="open = false" x-show="open"
                            class="absolute right-0 mt-2 py-2 w-48 bg-white rounded-md shadow-xl z-20">
                            @foreach ($levels as $item)
                                <a wire:click="$set('level_id',{{ $item->id }})" x-on:click="open = false"
                                    class="cursor-pointer block px-4 py-2 text-sm capitalize text-gray-700 hover:bg-blue-500 hover:text-white">
                                    {{ $item->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class=" container grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-x-6 gap-y-8 mt-6">
        @foreach ($cursos as $curso)
            <x-course-index :curso="$curso" />
        @endforeach
    </div>
    <div class="container py-4">
        {{ $cursos->links() }}
    </div>
</div>
<style>
    .whatsapp {
        position: fixed;
        width: 60px;
        height: 60px;
        bottom: 40px;
        right: 40px;
        background-color: #25d366;
        color: #FFF;
        border-radius: 50px;
        text-align: center;
        font-size: 40px;
        z-index: 1000;
    }

    .whatsapp i {
        margin-top: 10px;
    }

    /* animacion de hover */


    .whatsapp:hover i {
        animation: jello 1.5s;
        animation-iteration-count: infinite;
    }

    @keyframes jello {
        0% {
            transform: scale(1, 1);
        }

        30% {
            transform: scale(1.25, 0.75);
        }

        40% {
            transform: scale(0.75, 1.25);
        }

        50% {
            transform: scale(1.15, 0.85);
        }

        65% {
            transform: scale(0.95, 1.05);
        }

        75% {
            transform: scale(1.05, 0.95);
        }

        100% {
            transform: scale(1, 1);
        }
    }
</style>
<div>
    {{-- whatsapp walink --}}
    <a href="https://wa.link/asyko9" class="whatsapp" target="_blank">
        <i class="fab fa-whatsapp"></i>
    </a>
</div>