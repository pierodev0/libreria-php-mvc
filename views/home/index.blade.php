@extends('layouts.app') <!-- Extiende el layout base -->

@section('title', 'Inicio') <!-- Define el título específico -->

@section('content')
    <h2>Bienvenido a la página de inicio {{ $name }}</h2>
    <p>Este es el contenido principal de la página de inicio.</p>
    <button class="btn">Default</button>
@endsection