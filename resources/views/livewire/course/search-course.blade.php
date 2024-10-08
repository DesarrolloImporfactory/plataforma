<div>
    <x-input-search>
        <input wire:model='search' wire:model='search' type="text" id="table-search"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="Buscar cursos..">
        @if ($search)
            <ul class="absolute left-0 w-full bg-white mt-1 rounded-lg overflow-hidden">
                @forelse ($this->result as $item)
                    <a href="{{ route('cursos.show', $item) }}">
                        <li class="text-sm leading-10 px-5 cursor-pointer hover:bg-gray-300">{{ $item->title }}</li>
                    </a>
                @empty
                    <li class="text-sm leading-10 px-5 cursor-pointer hover:bg-gray-300">No existe coincidencias <i
                            class="fa-solid fa-heart-crack"></i></li>
                @endforelse
            </ul>
        @endif
    </x-input-search>

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