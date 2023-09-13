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
