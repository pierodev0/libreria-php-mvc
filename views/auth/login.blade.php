@extends('layouts.auth') <!-- Extiende el layout base -->

@section('title', 'Login') <!-- Define el título específico -->

@include('partials.alertas')
@section('content')
<main class="min-h-screen bg-base-200  flex  flex-col justify-center items-center p-4 sm:p- space-y-4 sm:space-y-10">
    <h1 class="text-2xl font-bold ">Sign in to your account
    </h1>
    <form action="/login" class="w-full sm:max-w-lg p-6 md:p-8 space-y-6 bg-white  rounded-lg shadow" method="post">
      <div>
        <fieldset class="fieldset">
          <label for="correo" class="fieldset-legend text-lg">Correo</label>
          <input id="correo" type="text" class="input input-primary w-full" name="email"  />
        </fieldset>
        <fieldset class="fieldset">
         <div class="flex items-center justify-between">
          <label for="password" class="fieldset-legend text-lg">Password</label>
          <a href="/forgot-password"  class="font-bold text-primary">Forgot password</a>
         </div>
          <input id="password" type="password" class="input input-primary w-full"  name="password"/>
        </fieldset>
      </div>
      <button type="submit" class="btn btn-primary w-full">Registrarse</button>
    </form>
    <p>Not a member? <a href="/register" class="font-bold text-primary">Start a 14 day free trial</a></p>
  </main>
@endsection