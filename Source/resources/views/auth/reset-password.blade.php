@section('title', 'B&B - Nieuw wachtwoord instellen')

<x-layouts.auth>
    <form class="m-auto w-10/12 lg:w-6/12 xl:w-4/12 flex flex-col gap-4 mt-10" method="POST"
        action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

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
        <h1 class="text-xl lg:text-2xl font-bold">Wachtwoord vergeten</h1>

        <label class="flex flex-col text-md" for="email">E-mail
            <input type="email" name="email" id="email" value="{{ old('email', $request->email) }}" required
                readonly class="block w-full">
        </label>

        <label class="flex flex-col text-md" for="password">Nieuw wachtwoord
            <input type="password" name="password" id="password" required readonly class="block w-full">
        </label>

        <label class="flex flex-col text-md" for="password_confirmation">Herhaal nieuw wachtwoord
            <input type="password" name="password_confirmation" id="password_confirmation" required readonly
                class="block w-full">
        </label>

        <button type="submit">Nieuw wachtwoord instellen</button>

        <h1 class="text-center text-sm">Hier inloggen:
            <a class="text-blue-400" href="/login">Inloggen</a>
        </h1>
    </form>

</x-layouts.auth>
