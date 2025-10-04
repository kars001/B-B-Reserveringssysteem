@section('title', 'B&B - Register')

<x-layouts.auth>
    <form class="m-auto w-10/12 lg:w-6/12 xl:w-4/12 flex flex-col gap-4 mt-10" method="post" action="{{ route('register') }}">
        @csrf

        <img class="w-50 m-auto" src="{{ asset('storage/tallandlogo.webp') }}" alt="logo">
        <div class="m-auto">
            @if ($errors->any())
                <ul class="text-center text-red-600 font-semibold">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
        <h1 class="text-xl lg:text-2xl font-bold">B&B account aanmaken</h1>

        <label class="flex flex-col text-md" for="name">Naam
            <input class="flex flex-col text-md" type="text" id="name" name="name" required placeholder="Minimaal 2 characters"/>
        </label>

        <label class="flex flex-col text-md" for="email">E-mail
            <input type="email" id="email" name="email" required placeholder="Geldige email"/>
        </label>

        <label class="flex flex-col text-md" for="password">Wachtwoord
            <input type="password" id="password" name="password" required placeholder="Minimaal 8 characters"/>
        </label>

        <label class="flex flex-col text-md" for="password_confirmation">Herhaal wachtwoord
            <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="Minimaal 8 characters"/>
        </label>

        <label class="flex flex-col text-md" for="license">Sleutel
            <input type="text" id="license" name="license" required placeholder="Geldige sleutel"/>
        </label>

        <button type="submit">Aanmelden</button>

        <h1 class="text-center text-sm">Hier inloggen:
            <a class="text-blue-400" href="/login">Inloggen</a>
        </h1>
    </form>

</x-layouts.auth>
