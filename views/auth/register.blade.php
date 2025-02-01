@extends('layouts.auth') <!-- Extiende el layout base -->

@section('title', 'Login') <!-- Define el título específico -->



@section('content')
    <main class="min-h-screen bg-base-200  flex  flex-col justify-center items-center p-4 sm:p- space-y-4 sm:space-y-10">

        <h1 class="text-2xl font-bold ">Create an account
        </h1>

        @include('partials.alertas')
        <form action="/register" class="w-full sm:max-w-lg p-6 md:p-8 space-y-6 bg-white  rounded-lg shadow" method="post">

            <div>
                <fieldset class="fieldset">
                    <label for="name" class="fieldset-legend text-lg">What should we call you?
                    </label>
                    <input id="name" type="text" class="input input-primary w-full" />
                </fieldset>
                <fieldset class="fieldset">
                    <label for="correo" class="fieldset-legend text-lg">Email</label>
                    <input id="email" type="text" class="input input-primary w-full" name="email"/>
                </fieldset>

                <fieldset class="fieldset">
                    <div class="flex items-center justify-between">
                        <label for="password" class="fieldset-legend text-lg">Password</label>

                    </div>
                    <input id="password" type="password" class="input input-primary w-full" name="password" />
                </fieldset>
                <fieldset class="fieldset">
                    <div class="flex items-center justify-between">
                        <label for="password" class="fieldset-legend text-lg">Repeat password</label>

                    </div>
                    <input id="password" type="password" class="input input-primary w-full" name="password_confirmation" />
                </fieldset>
            </div>
            <fieldset class="flex items-center gap-4">
                <input type="checkbox" checked="checked" class="checkbox" id="conditions" />
                <label for="conditions">I Accept <span class="font-bold text-primary">Terms and conditions</span></label>
            </fieldset>
            <button type="submit" class="btn btn-primary w-full">Create an account</button>
        </form>
        <p>Already have an account? <a href="/login" class="font-bold text-primary"> Login here</a></p>
    </main>
@endsection


