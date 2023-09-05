<div>
    <x-slot name=curso>
        {{ $curso->id }}
    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('View course') }}
        </h2>
    </x-slot>

    <div class="px-6 py-4 text-gray-600">
        <h1 class="text-2xl font-bold text-white"><i
                class="fa-solid fa-circle-info mr-2"></i>INFORMACIÓN DEL CURSO</h1>
        <hr class="mt-2 mb-6">
        {{$lesson->name}}
        @foreach ($curso->section as $item)
            <article class="card dark:bg-gray-300 rounded mb-6">
                <div class="px-4 py-6">
                        <header class="flex justify-between items-center">
                            <h1 class="cursor-pointer">Sección:<strong>{{$item->name}}</strong></h1>
                            <div>
                                <i class="mr-4 fa-solid fa-pen-nib cursor-pointer text-blue-500" wire:click='edit({{$item}})'></i>
                                <i class="fa-solid fa-delete-left cursor-pointer text-red-500"></i>
                            </div>
                        </header>
                </div>
            </article>
        @endforeach
    </div>
</div>
