@extends('layouts.dashboard') <!-- Extiende el layout base -->

@section('title', 'Inicio') <!-- Define el título específico -->
{{-- @include('partials.alerta') --}}
@section('content')
    <h2 class="text-2xl font-bold text-center mb-2">Mi correo: {{ Session::get('email') }} </h2>
@endsection
