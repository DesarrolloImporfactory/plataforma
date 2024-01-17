<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create course') }}
        </h2>
    </x-slot>

    <div class="container py-8">
        <div class="grid grid-cols-5">
            <aside>
                <h1 class="font-bold text-lg mb-4 dark:text-gray-300">Registro del curso</h1>
                <ul class="text-sm text-gray-600">
                    <li class="leading-7 mb-1 border-l-4 border-indigo-400 pl-2"><a href="">informacion del
                            curso</a></li>
                    <li class="leading-7 mb-1 border-l-4 border-transparent pl-2"><a href="">lecciones del
                            curos</a></li>
                    <li class="leading-7 mb-1 border-l-4 border-transparent pl-2"><a href="">metas del curso</a>
                    </li>
                    <li class="leading-7 mb-1 border-l-4 border-transparent pl-2"><a href="">estudiantes</a></li>
                </ul>
            </aside>
            <div class="col-span-4 card rounded">
                <div class="px-6 py-4 text-gray-600">
                    <h1 class="text-2xl font-bold dark:text-white"><i class="fa-solid fa-circle-info mr-2"></i>INFORMACIÓN DEL CURSO</h1>
                    <hr class="mt-2 mb-6">
                 @livewire('instructor.create-curso')
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
