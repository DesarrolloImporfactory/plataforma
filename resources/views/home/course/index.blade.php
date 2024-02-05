<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Nuestros cursos') }}
        </h2>
    </x-slot>

    <section class="bg-cover shadow-xl" style="background-image: url({{ asset('img/home/baner.jpg') }})">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-36">
            <div class="w-full md:w-3/4 lg:w-1/2">
                <h1 class="text-white font-bold text-4xl">IMPORFACTORY</h1>
                <p class="text-white text-lg mt-2 mb-4">La red de Importadores e Ecommerce más grande de habla hispana.</p>
            </div>
        </div>
    </section>
    @if (session('mensaje'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Bienvenido al sistema educativo',
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif

    @livewire('course.course-index')
</x-app-layout>
