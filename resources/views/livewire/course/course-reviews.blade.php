<section>
    <h1 class="text-gray-800 dark:text-gray-200 text-2xl mt-6">Valoraciones del curso</h1>
    @can('matriculado', $curso)
        <article class="mt-4">
            @can('valued', $curso)
                <textarea wire:model='comment' cols="30" rows="3" class="form-input w-full"
                    placeholder="ingrese una reseña del curso"></textarea>
                <div class="flex">
                    <x-button wire:click='store'>Guardar</x-button>
                    <ul class="flex items-center ml-4">
                        <li class="mr-1 cursor-pointer" wire:click="$set('rating',1)"><i
                                class="fas fa-star {{ $rating >= 1 ? 'text-yellow-400' : 'text-gray-400' }}"></i>
                        </li>
                        <li class="mr-1 cursor-pointer" wire:click="$set('rating',2)"><i
                                class="fas fa-star {{ $rating >= 2 ? 'text-yellow-400' : 'text-gray-400' }}"></i>
                        </li>
                        <li class="mr-1 cursor-pointer" wire:click="$set('rating',3)"><i
                                class="fas fa-star {{ $rating >= 3 ? 'text-yellow-400' : 'text-gray-400' }}"></i>
                        </li>
                        <li class="mr-1 cursor-pointer" wire:click="$set''('rating',4)"><i
                                class="fas fa-star {{ $rating >= 4 ? 'text-yellow-400' : 'text-gray-400' }}"></i>
                        </li>
                        <li class="mr-1 cursor-pointer" wire:click="$set('rating',5)"><i
                                class="fas fa-star {{ $rating == 5 ? 'text-yellow-400' : 'text-gray-400' }}"></i>
                        </li>
                    </ul>
                </div>
            @else
                <div class="dark:bg-blue-900 overflow-hidden shadow-lg rounded">
                    <div class="px-4 py-6">
                        <div class="flex items-center">
                            <i class="fa-solid fa-list-check text-white mr-2"></i>
                            <p class="text-white">Usted ya agrego una reseña al curso</p>
                        </div>
                    </div>
                </div>
            @endcan
        </article>
    @endcan
    <div class="card rounded mt-4">
        <div class="px-4 py-6">
            <p class="dark:text-gray-200 text-xl mb-2">{{ $curso->reviews->count() }} Valoraciones</p>
            @foreach ($curso->reviews as $review)
                <article class="flex mb-4 text-gra-800">
                    <figure class="mr-4">
                        <img class="rounded-full h12 w-12 object-cover" src="{{ $review->users->profile_photo_url }}"
                            alt="">
                    </figure>
                    <div class="card rounded flex-1">
                        <div class="px-4 py-2 bg-gray-100">
                            <p><b>{{ $review->users->name }}</b><i
                                    class="fa-solid fa-star text-yellow-400 ml-2 mr-2"></i>{{ $review->rating }}.</p>
                            {{ $review->comment }}
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
