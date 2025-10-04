<div>
    <div class="max-w-4xl mx-auto">
        <h1 class="text-2xl font-bold text-left">Account Instellingen</h1>
        @if ($successMessage)
        <div class="text-green-600 text-sm mb-2">{{ $successMessage }}</div>
        @endif
        <hr class="text-gray-400 my-8 items-center justify-center">
        <form wire:submit="updateInfo">
            @csrf
            <div class="flex max-md:flex-col max-md:gap-8 justify-between mx-auto">
                <div class="flex flex-col gap-1">
                    <h1>Persoonlijke Gegevens</h1>
                    <p class="text-gray-500 text-sm">Dit zijn de gegevens die we hebben over jou.</p>
                </div>
                <div class="flex flex-col w-80">
                    <label for="email" class="text-sm font-medium">E-mail</label>
                    <input wire:model="email" class="w-full" type="email" placeholder="E-mail">
                    @error('email')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror

                    <div class="flex justify-end">
                        <button type="submit" class="w-fit">Opslaan</button>
                    </div>
                </div>
            </div>
        </form>

        <hr class="text-gray-400 my-8 items-center justify-center">
        <form wire:submit="updateInfo" method="post">
            @csrf
            <div class="flex max-md:flex-col max-md:gap-8 justify-between mx-auto">
                <div class="flex flex-col gap-1">
                    <h1>Wachtwoord Wijzigen</h1>
                    <p class="text-gray-500 text-sm">Hier kun je je wachtwoord wijzigen.</p>
                </div>
                <div class="flex flex-col gap-2 w-80">
                    <form wire:submit="updatePassword" method="post">
                        @csrf

                        <div class="flex flex-col gap-3">
                            <div>
                                <label for="current_password" class="text-sm font-medium">Oude wachtwoord</label>
                                <input wire:model="current_password" class="w-full" type="password">
                                @error('current_password')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="new_password" class="text-sm font-medium">Nieuw wachtwoord</label>
                                <input wire:model="new_password" class="w-full" type="password" @error('new_password') <span class="text-sm text-red-500">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="new_password_confirmation" class="text-sm font-medium">Herhaal nieuw wachtwoord</label>
                                <input wire:model="new_password_confirmation" class="w-full" type="password" @error('new_password_confirmation') <span class="text-sm text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="w-fit">Wachtwoord veranderen</button>
                        </div>
                    </form>
                </div>
            </div>
        </form>
    </div>
</div>
