@extends('adminlte::page')

@section('title', 'setings')

@section('content_header')
    <h1>Configuraciones del sistema de cursos</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-4">
            @livewire('admin.category-admin')
        </div>
        <div class="col-md-4">
            @livewire('admin.level-admin')
        </div>
        <div class="col-md-4">
            @livewire('admin.price-admin')
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
