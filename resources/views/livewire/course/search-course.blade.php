<form class="pt-2 relative mx-auto text-gray-600 mt-5" autocomplete="off">
    <input wire:model='search'
        class="w-full border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none"
        type="search" name="search" placeholder="Search">
    <a class="btn btn-danger absolute right-0 top-0 mt-2">
        Buscar
    </a>
    @if ($search)
        <ul class="absolute left-0 w-full bg-white mt-1 rounded-lg overflow-hidden">
            @forelse ($this->result as $item)
                <a href="{{ route('cursos.show', $item) }}">
                    <li class="text-sm leading-10 px-5 cursor-pointer hover:bg-gray-300">{{ $item->title }}</li>
                </a>
            @empty
                <li class="text-sm leading-10 px-5 cursor-pointer hover:bg-gray-300">No existe coincidencias <i class="fa-solid fa-heart-crack"></i></li>
            @endforelse
        </ul>
    @endif
</form>
