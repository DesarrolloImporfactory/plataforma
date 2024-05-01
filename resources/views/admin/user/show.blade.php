@extends('adminlte::page')

@section('title', 'Show user')

@section('content_header')
  <div class="mt-1">
    
  </div>
@stop

@section('content')
    @livewire('users.update-user', ['user' => $user], key($user))
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop 