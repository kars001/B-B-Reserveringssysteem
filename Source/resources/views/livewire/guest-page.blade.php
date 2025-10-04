<div class="flex flex-col gap-8">
    <div class="flex gap-3 items-center justify-between">
        <div class="flex flex-col gap-1">
            <h1 class="md:text-4xl text-2xl font-bold">Gasten Beheren</h1>
            <p class="text-gray-500/60">Beheer gasten informatie.</p>
        </div>
        <div x-data="{ guestModal: false }" @close-modal.window="guestModal = false">
            <button type="submit" @click="guestModal = true">
                Creeër gast
            </button>

            <div x-show="guestModal" x-transition
                class="fixed overflow-hidden inset-0 flex items-center bg-black\50 backdrop-blur-sm justify-center z-50">
                <div
                    class="relative bg-white rounded-lg shadow-lg p-6 w-full max-w-2xl z-10 max-h-screen sm:max-h-[90vh] overflow-y-auto">
                    <h2 class="text-lg font-bold">Gast aanmaken</h2>
                    <p class="text-gray-700 mb-4">Hier kun je een nieuwe gast aanmaken.</p>

                    <form wire:submit="createGuest" class="flex flex-col gap-3">
                        @csrf

                        <div class="flex gap-3">
                            <label class="flex flex-col text-sm font-medium w-full" for="firstName">Voornaam
                                <input wire:model="firstName" id="firstName" type="text" required>
                                @error('firstName')
                                    <span class="text-sm text-red-500">{{ $message }}</span>
                                @enderror
                            </label>

                            <label class="flex flex-col text-sm font-medium w-full" for="lastName">Achternaam
                                <input wire:model="lastName" id="lastName" type="text">
                                @error('lastName')
                                    <span class="text-sm text-red-500">{{ $message }}</span>
                                @enderror
                            </label>
                        </div>

                        <div class="flex flex-col gap-3">
                            <label class="flex flex-col text-sm font-medium w-full" for="adres">Adres
                                <input wire:model="adres" id="adres" type="text">
                                @error('adres')
                                    <span class="text-sm text-red-500">{{ $message }}</span>
                                @enderror
                            </label>

                            <label class="flex flex-col text-sm font-medium w-full" for="email">E-mail
                                <input wire:model="email" id="email" type="text">
                                @error('email')
                                    <span class="text-sm text-red-500">{{ $message }}</span>
                                @enderror
                            </label>

                            <label class="flex flex-col text-sm font-medium w-full" for="phonenumber">Telefoonnummer
                                <input wire:model="phonenumber" id="phonenumber" type="tel">
                                @error('phonenumber')
                                    <span class="text-sm text-red-500">{{ $message }}</span>
                                @enderror
                            </label>

                            <label class="flex flex-col text-sm font-medium w-full" for="comments">Commentaar
                                <textarea wire:model="comments" id="comments" rows="8"></textarea>
                                @error('comments')
                                    <span class="text-sm text-red-500">{{ $message }}</span>
                                @enderror
                            </label>
                        </div>

                        <div class="flex gap-3">
                            <button class="w-fit" type="submit">Gast aanmaken</button>
                            <button @click="guestModal = false"
                                class="bg-gray-200 hover:bg-gray-300 text-sm transition-colors py-2 px-3 rounded-lg cursor-pointer">
                                Annuleren
                            </button>
                        </div>

                        <button @click="guestModal = false"
                            class="absolute top-2 right-3 text-gray-500 hover:text-gray-700 text-3xl cursor-pointer">
                            &times;
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div>
        <table class="min-w-full bg-white rounded-lg ring-2 ring-gray-200">
            <thead>
                <tr>
                    <th class="px-2 sm:px-4 py-2 text-left text-sm md:text-md text-gray-600">Voornaam</th>
                    <th class="px-2 sm:px-4 py-2 text-left text-sm md:text-md text-gray-600">Achternaam</th>
                    <th class="px-2 sm:px-4 py-2 text-left text-sm md:text-md text-gray-600">Telefoonnummer</th>
                    <th class="px-2 sm:px-4 py-2 text-left text-sm md:text-md text-gray-600">Acties</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($guests as $guest)
                    <tr class="border-t border-gray-200 hover:bg-gray-50">
                        <td class="px-2 sm:px-4 py-2 text-[12px] md:text-md">{{ $guest->firstName ?? 'geen' }}</td>
                        <td class="px-2 sm:px-4 py-2 text-[12px] md:text-md">{{ $guest->lastName ?? 'geen' }}</td>
                        <td class="px-2 sm:px-4 py-2 text-[12px] md:text-md">{{ $guest->phonenumber ?? 'geen' }}</td>
                        <td class="px-2 sm:px-4 py-2 text-[12px] md:text-md">
                            <button wire:click="editGuest({{ $guest->id }})"
                                class="bg-blue-200 text-black px-2 py-1 rounded-md hover:bg-blue-300 hover:cursor-pointer">
                                Bekijk/Wijzig
                            </button>
                            <button wire:click="deleteGuest({{ $guest->id }})" type="button" @click="editGuest = false"
                                class="bg-red-200 hover:bg-red-300 py-1 px-2 rounded-md cursor-pointer">
                                Verwijderen
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div x-data="{ editGuest: false }" x-transition @close-modal.window="guestModal = false" x-on:open-edit-modal.window="editGuest = true" x-show="editGuest"
            class="fixed overflow-hidden inset-0 flex items-center bg-black\50 backdrop-blur-sm justify-center z-50">

            <div
                class="relative bg-white rounded-lg shadow-lg p-6 w-full max-w-2xl z-10 sm:max-h-[90vh] overflow-y-auto">
                <h2 class="text-lg font-bold">Gast bewerken/bekijken</h2>
                <p class="text-gray-700 mb-4">Hier kun je een gast bewerken of bekijken.</p>

                <form wire:submit.prevent="updateGuest" class="flex flex-col gap-3">
                    @csrf

                    <div class="flex gap-3">
                        <label class="flex flex-col text-sm font-medium w-full" for="firstName">Voornaam
                            <input wire:model.defer="firstNameEdit" id="firstName" type="text" required>
                            @error('firstNameEdit')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </label>

                        <label class="flex flex-col text-sm font-medium w-full" for="lastName">Achternaam
                            <input wire:model.defer="lastNameEdit" id="lastName" type="text">
                            @error('lastNameEdit')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </label>
                    </div>

                    <div class="flex flex-col gap-3">
                        <label class="flex flex-col text-sm font-medium w-full" for="adres">Adres
                            <input wire:model.defer="adresEdit" id="adres" type="text">
                            @error('adresEdit')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </label>

                        <label class="flex flex-col text-sm font-medium w-full" for="email">E-mail
                            <input wire:model.defer="emailEdit" id="email" type="email">
                            @error('emailEdit')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </label>

                        <label class="flex flex-col text-sm font-medium w-full" for="phonenumber">Telefoonnummer
                            <input wire:model.defer="phonenumberEdit" id="phonenumber" type="tel">
                            @error('phonenumberEdit')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </label>

                        <label class="flex flex-col text-sm font-medium w-full" for="comments">Commentaar
                            <textarea wire:model.defer="commentsEdit" id="comments" rows="8"></textarea>
                            @error('commentsEdit')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </label>
                    </div>

                    <div class="flex gap-3">
                        <button type="submit">
                            Opslaan
                        </button>
                        <button wire:click="resetForm" type="button" @click="editGuest = false"
                            class="bg-gray-200 hover:bg-gray-300 text-sm transition-colors py-2 px-3 rounded-lg cursor-pointer">
                            Annuleren
                        </button>
                    </div>

                    <button wire:click="resetForm" type="button" @click="editGuest = false"
                        class="absolute top-2 right-3 text-gray-500 hover:text-gray-700 text-3xl cursor-pointer">
                        &times;
                    </button>
                </form>
            </div>
        </div>

        @if ($guests->hasPages())
            <div class="mt-4">
                {{ $guests->links('vendor.livewire.tailwind') }}
            </div>
        @endif
    </div>
</div>
