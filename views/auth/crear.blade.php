@extends('layouts.app') <!-- Extiende el layout base -->

@section('title', 'Crear cuenta') <!-- Define el título específico -->

@section('content')
    <form action="/crear" class="space-y-4" method="post">
        <div class="space-y-4">
            <div class="flex flex-col md:flex-row items-start gap-2 md:items-center">
                <label for="" class="">
                  Correo
                </label>
                <input type="text" placeholder="Type here" class="input input-bordered w-full " name="email"/>
            </div>
            <div class="flex flex-col md:flex-row items-start gap-2 md:items-center">
                <label for="" class="">
                  Password
                </label>
                <input type="password" placeholder="Type here" class="input input-bordered w-full " name="password"/>
            </div>
        </div>
        <button type="submit" class="btn btn-primary w-full sm:w-auto">Crear</button>
    </form>
@endsection