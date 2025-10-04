@section('title', 'B&B - Login')

<x-layouts.auth>
    <form class="m-auto w-10/12 lg:w-6/12 xl:w-4/12 flex flex-col gap-4 mt-10" method="post" action="{{ route('login') }}">
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
        <h1 class="text-xl lg:text-2xl font-bold">B&B inloggen</h1>

        <label class="flex flex-col text-md" for="email">E-mail
            <input type="email" id="email" name="email" required />
        </label>

        <label class="flex flex-col text-md" for="password">
            <div class="flex justify-between gap-2">
                <span>Wachtwoord</span>
                <a href="/forgot-password">Wachtwoord vergeten</a>
            </div>
            <input type="password" id="password" name="password" required />
        </label>

        <button type="submit">Inloggen</button>

        <h1 class="text-center text-sm">Maak hier een account aan:
            <a class="text-blue-400" href="/register">Aanmelden</a>
        </h1>
    </form>

</x-layouts.auth>
