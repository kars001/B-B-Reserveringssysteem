@section('title', 'B&B - Wachtwoord vergeten')

<x-layouts.auth>
    <form class="m-auto w-10/12 lg:w-6/12 xl:w-4/12 flex flex-col gap-4 mt-10" method="POST"
        action="{{ route('password.email') }}">
        @csrf

        <img class="w-50 m-auto" src="{{ asset('storage/tallandlogo.webp') }}" alt="logo">
        <div class="m-auto">
            @if (session('status'))
                <p class="text-center text-gray-800 font-semibold">{{ session('status') }}</p>
            @endif

        </div>
        <h1 class="text-xl lg:text-2xl font-bold">Wachtwoord vergeten</h1>

        <label class="flex flex-col text-md" for="email">E-mail
            <input type="email" name="email" id="email" autocomplete="email" required class="block w-full">
        </label>

        <button type="submit">Wachtwoord resetten</button>

        <h1 class="text-center text-sm">Hier inloggen:
            <a class="text-blue-400" href="/login">Inloggen</a>
        </h1>
    </form>

</x-layouts.auth>
