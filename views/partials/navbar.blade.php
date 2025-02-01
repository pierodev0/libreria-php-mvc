<div class="navbar bg-base-100 container mx-auto">
    <div class="flex-1">
        <a class="btn btn-ghost text-xl" href="/">Libreria</a>
    </div>
    <div class="flex-none">
        <ul class="flex gap-2">
            @if (Helpers\Session::get('login'))
                <li class="btn btn-ghost"><a href="/login">Perfil</a></li>
                <li class="btn "><a href="/logout">Log out</a></li>
            @else
                <li class="btn btn-ghost"><a href="/login">Login</a></li>
                <li class="btn btn-primary"><a href="/register">Register</a></li>
            @endif
        </ul>
    </div>
</div>
