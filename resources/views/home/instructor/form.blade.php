<div class="mb-6 grid grid-cols-5 gap-8">
    <div class="col-span-3">
        <x-label>Título del curso:</x-label>
        <x-input wire:keydown='slugChange' wire:model='title' type="text" class="w-full" placeholder=''></x-input>
        <x-input-error for='title' />
    </div>
    <div class="col-span-2">
        <x-label for="email">Slug del curso:</x-label>
        <x-input wire:model='slug' readonly type="text" class="w-full" placeholder=''></x-input>
        <x-input-error for='slug' />
    </div>
</div>
<div class="mb-6">
    <x-label for="password">Subtítulo del curso:</x-label>
    <x-input wire:model='subtitle' type="text" class="w-full" placeholder=''></x-input>
    <x-input-error for='subtitle' />
</div>
<div class="mb-6">
    <div wire:ignore>
        <x-label for="password">Descripción del curso:</x-label>
        <div class="w-full" id='description'>
            {!! $description !!}
        </div>
    </div>
    <x-input-error for='description' />
</div>
<div class="grid grid-cols-3 gap-8 mb-6">
    <div>
        <x-label>Categoría:</x-label>
        <select wire:model='categorie_id' id="countries"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            @foreach ($categorias as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select>
        <x-input-error for='categorie_id' />
    </div>
    <div>
        <x-label>Niveles:</x-label>
        <select wire:model='level_id' id="countries"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            @foreach ($niveles as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select>
        <x-input-error for='level_id' />
    </div>
    <div>
        <x-label>Precios:</x-label>
        <select wire:model='price_id' id="countries"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            @foreach ($precios as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select>
        <x-input-error for='price_id' />
    </div>
</div>
<div class="mb-6 grid grid-cols-2 gap-8">
    <div>
        <div>
            <label for="dropzone-file"
                class="mx-auto cursor-pointer flex w-full max-w-lg flex-col items-center rounded-xl border-2 border-dashed border-blue-400 bg-white p-6 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-500" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                </svg>

                <h2 class="mt-4 text-xl font-medium text-gray-700 tracking-wide">Imagen del curso</h2>

                <p class="mt-2 text-gray-500 tracking-wide">Upload or darg & drop your file SVG, PNG, JPG or
                    GIF. </p>

                <input id="dropzone-file" type="file" wire:model="photo" class="hidden" />
            </label>
            <x-input-error for='photo' />
        </div>
        <button type="submit"
            class="text-white  mt-4 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full  px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Actualizar
            información</button>
    </div>
    <div>
        @if ($photo)
            <img class="object-cover h-64 w-full rounded" src="{{ $photo->temporaryUrl() }}">
        @else
            <img class="object-cover h-64 w-full rounded" src="{{ Storage::url($imagen) }}" alt="Subir imagen">
        @endif
    </div>
</div>
