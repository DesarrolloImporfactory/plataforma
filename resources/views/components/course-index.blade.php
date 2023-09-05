@props(['curso'])
<article class="card rounded">
    <img class="h-36 w-full object-cover" src="{{ Storage::url($curso->image->url) }}" alt="">
    <div class="px-6 py-4">
        <h1 class="card-title">{{ Str::limit($curso->title, 40) }}</h1>
        <p class="text-gray-500 text-sm mb-2">Prof: {{ $curso->teacher->name }}</p>
        <div class="flex mt-3">
            <ul class="flex text-sm">
                <li class="mr-1"><i
                        class="fas fa-star {{ $curso->rating >= 1 ? 'text-yellow-400' : 'text-gray-400' }}"></i>
                </li>
                <li class="mr-1"><i
                        class="fas fa-star {{ $curso->rating >= 2 ? 'text-yellow-400' : 'text-gray-400' }}"></i>
                </li>
                <li class="mr-1"><i
                        class="fas fa-star {{ $curso->rating >= 3 ? 'text-yellow-400' : 'text-gray-400' }}"></i>
                </li>
                <li class="mr-1"><i
                        class="fas fa-star {{ $curso->rating >= 4 ? 'text-yellow-400' : 'text-gray-400' }}"></i>
                </li>
                <li class="mr-1"><i
                        class="fas fa-star {{ $curso->rating == 5 ? 'text-yellow-400' : 'text-gray-400' }}"></i>
                </li>
            </ul>
            <p class="text-sm text-gray-500 ml-auto"><i class="fa-solid fa-user"></i>
                {{ $curso->students_count }}</p>
        </div>
        <a href="{{ route('cursos.show', $curso) }}"
            class="btn-block btn btn-primary mt-4 ">
            Más información
        </a>
    </div>
</article>
