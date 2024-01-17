<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link href='https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css' rel='stylesheet' type='text/css' />
    
    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <x-banner />

    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @livewire('navigation-menu')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif
        {{-- border-indigo-400 --}}
        <!-- Page Content -->
        <div class="container py-8">
            <div class="grid grid-cols-5 gap-8">
                <aside>
                    <h1 class="font-bold text-base mb-4 text-gray-400 dark:text-gray-300">GESTIÓN DEL CURSO</h1>
                    <ul class="text-base  mb-6">
                        <li
                            class="leading-7 mb-4 border-l-4 rounded {{ request()->routeIs('instructor.cursos.admin.show') ? 'border-indigo-600 text-indigo-600 dark:bg-indigo-200' : 'text-gray-600 border-transparent' }} pl-2">
                            <a href="{{ route('instructor.cursos.admin.show', $curso) }}">Informacion del
                                curso</a>
                        </li>
                        <li
                            class="rounded leading-7 mb-4 border-l-4 {{ request()->routeIs('instructor.cursos.curriculum') ? 'border-indigo-600 text-indigo-600 dark:bg-indigo-200' : 'text-gray-600 border-transparent' }} pl-2">
                            <a href="{{ route('instructor.cursos.curriculum', $curso) }}">Lecciones del
                                curos</a>
                        </li>
                        <li
                            class="rounded leading-7 mb-4 border-l-4 {{ request()->routeIs('instructor.cursos.metas') ? 'border-indigo-600 text-indigo-600 dark:bg-indigo-200' : 'text-gray-600 border-transparent' }}  pl-2">
                            <a href="{{ route('instructor.cursos.metas', $curso) }}">Metas del
                                curso</a>
                        </li>
                        <li
                            class="rounded leading-7 mb-4 border-l-4 {{ request()->routeIs('instructor.cursos.estudiantes') ? 'border-indigo-600 text-indigo-600 dark:bg-indigo-200' : 'text-gray-600 border-transparent' }} pl-2">
                            <a href="{{ route('instructor.cursos.estudiantes', $curso) }}">Estudiantes</a>
                        </li>

                        <li
                            class="rounded leading-7 mb-4 border-l-4 {{ request()->routeIs('instructor.cursos.observaciones') ? 'border-indigo-600 text-indigo-600 dark:bg-indigo-200' : 'text-gray-600 border-transparent' }} pl-2">
                            <a href="{{ route('instructor.cursos.observaciones', $curso) }}">Observaciones</a>
                        </li>
                    </ul>
                    @livewire('aprobar-curso', ['curso' => $curso], key($curso->id))
                    {{-- <form action="{{ route('instructor.cursos.estatus', $curso) }}" method="post">
                        @csrf
                        <x-danger-button type="submit">Solicitar revisión</x-danger-button>
                    </form>
                    @if (Session::has('message'))
                        <script>
                            Swal.fire('{{ Session::get('message') }}')
                        </script>
                    @endif --}}

                </aside>
                <main class="col-span-4 card rounded">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </div>

    @stack('modals')
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js'></script> 
    @livewireScripts
    @stack('js')
    
    <script>
        
        Livewire.on('alert', message => {
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: message,
                showConfirmButton: false,
                timer: 1500
            })
        })
        Livewire.on('error', message => {
            Swal.fire(message)
        })
    </script>
</body>

</html>
