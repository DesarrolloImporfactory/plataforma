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