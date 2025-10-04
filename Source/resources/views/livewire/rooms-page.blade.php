<div x-data="{ showCreateModal: false, showEditModal: false, selectedType: $wire.entangle('type'), selectedRoomType: $wire.entangle('room_type') }" x-on:open-edit-modal.window="showEditModal = true">
    <div class="flex flex-row justify-between items-center">
        <div class="flex flex-col gap-1">
            <h1 class="md:text-4xl text-2xl font-bold">Kamers en Ruimtes</h1>
            <p class="text-gray-500/60">Beheer kamers en ruimtes.</p>
        </div>
        <button type="submit" wire:click="resetForm" @click="showCreateModal = true">Creëer</button>
    </div>

    <template x-if="showCreateModal">
        <div class="fixed inset-0 flex items-center justify-center z-50 backdrop-blur-sm">
            <div class="bg-white p-6 rounded-lg shadow-lg md:w-200 w-130 relative">
                <button class="absolute top-2 right-3 text-gray-500 hover:text-gray-700 hover:cursor-pointer text-3xl" @click="showCreateModal = false">&times;</button>
                <h2 class="text-xl font-bold mb-4">Nieuwe kamer of ruimte</h2>
                <p class="text-sm text-gray-500/60">Hier kunt u een nieuwe kamer of ruimte toevoegen, vul de volgende velden in en klik op "Creëer".</p>
                @if ($errors->any())
                <div class="text-red-500 text-sm mb-4">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="grid md:grid-cols-2 grid-cols-1 gap-2 mt-4">
                    <div class="flex flex-col gap-1">
                        <p class="text-sm text-gray-500/60">Naam Kamer of Ruimte</p>
                        <input type="text" required class="w-full rounded px-2 py-1 mb-4" placeholder="Naam" wire:model="name" />
                    </div>
                    <div class="flex flex-col gap-1">
                        <p class="text-sm text-gray-500/60">Kamer of Ruimte</p>
                        <select required class="w-full mb-4 bg-gray-200 outline-2 focus:outline-blue-200 rounded-lg px-2 py-1.5 outline-gray-200 text-sm" wire:model="type">
                            <option value="">Kies een optie</option>
                            <option value="room">Kamer</option>
                            <option value="hall">Ruimte</option>
                        </select>
                    </div>
                    <div class="flex flex-col gap-1">
                        <p class="text-sm text-gray-500/60">Aantal personen</p>
                        <input type="number" min="1" max="30" required class="w-full mb-4 bg-gray-200 outline-2 focus:outline-blue-200 rounded-lg px-2 py-1.5 outline-gray-200 text-sm" placeholder="Capaciteit" wire:model="capacity" />
                    </div>
                    <div class="flex flex-col gap-1">
                        <p class="text-sm text-gray-500/60">Prijs</p>
                        <input type="number" min="1" required class="w-full mb-4 bg-gray-200 outline-2 focus:outline-blue-200 rounded-lg px-2 py-1.5 outline-gray-200 text-sm" placeholder="Prijs" wire:model="price" />
                    </div>
                    <div class="flex flex-col gap-1">
                        <p class="text-sm text-gray-500/60">Verdieping</p>
                        <select required class="w-full mb-4 bg-gray-200 outline-2 focus:outline-blue-200 rounded-lg px-2 py-1.5 outline-gray-200 text-sm" wire:model="floor">
                            <option value="">Kies een optie</option>
                            <option value="begane grond">Begane grond</option>
                            <option value="1e verdieping">1e Verdieping</option>
                        </select>
                    </div>
                </div>
                <hr class="my-4 border-gray-200">
                <div class="grid md:grid-cols-2 grid-cols-1 gap-2 mt-4">
                    <div class="flex flex-col gap-1" x-show="selectedType === 'room'">
                        <p class="text-sm text-gray-500/60">Kamer type</p>
                        <select required class="w-full mb-4 bg-gray-200 outline-2 focus:outline-blue-200 rounded-lg px-2 py-1.5 outline-gray-200 text-sm" wire:model="room_type">
                            <option value="">Kies een optie</option>
                            <option value="Standard">Standaard</option>
                            <option value="Deluxe">Deluxe</option>
                        </select>
                    </div>
                </div>
                <div class="flex flex-row justify-end gap-2">
                    <button type="submit" wire:click="createRoomOrHall">Creëer</button>
                </div>
            </div>
        </div>
    </template>

    <template x-if="showEditModal">
        <div :key="$wire.editId" class="fixed inset-0 flex items-center justify-center z-50 backdrop-blur-sm">
            <div class="bg-white p-6 rounded-lg shadow-lg md:w-200 w-130 relative">
                <button class="absolute top-2 right-3 text-gray-500 hover:text-gray-700 hover:cursor-pointer text-3xl" @click="showEditModal = false">&times;</button>
                <h2 class="text-xl font-bold mb-4">Bewerk kamer of ruimte</h2>
                <p class="text-sm text-gray-500/60">Hier kunt u een kamer of ruimte bewerken, vul de volgende velden in en klik op "Bewerk".</p>
                @if ($errors->any())
                <div class="text-red-500 text-sm mb-4">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="grid md:grid-cols-2 grid-cols-1 gap-2 mt-4">
                    <div class="flex flex-col gap-1">
                        <p class="text-sm text-gray-500/60">Naam Kamer of Ruimte</p>
                        <input type="text" required class="w-full rounded px-2 py-1 mb-4" placeholder="Naam" wire:model="name" />
                    </div>
                    <div class="flex flex-col gap-1">
                        <p class="text-sm text-gray-500/60">Kamer of Ruimte</p>
                        <select required class="w-full mb-4 bg-gray-200 outline-2 focus:outline-blue-200 rounded-lg px-2 py-1.5 outline-gray-200 text-sm" wire:model="type">
                            <option value="">Kies een optie</option>
                            <option value="room">Kamer</option>
                            <option value="hall">Ruimte</option>
                        </select>
                    </div>
                    <div class="flex flex-col gap-1">
                        <p class="text-sm text-gray-500/60">Aantal personen</p>
                        <input type="number" min="1" max="30" required class="w-full mb-4 bg-gray-200 outline-2 focus:outline-blue-200 rounded-lg px-2 py-1.5 outline-gray-200 text-sm" placeholder="Capaciteit" wire:model="capacity" />
                    </div>
                    <div class="flex flex-col gap-1">
                        <p class="text-sm text-gray-500/60">Prijs</p>
                        <input type="number" min="1" required class="w-full mb-4 bg-gray-200 outline-2 focus:outline-blue-200 rounded-lg px-2 py-1.5 outline-gray-200 text-sm" placeholder="Prijs" wire:model="price" />
                    </div>

                    <div class="flex flex-col gap-1">
                        <p class="text-sm text-gray-500/60">Verdieping</p>
                        <select required class="w-full mb-4 bg-gray-200 outline-2 focus:outline-blue-200 rounded-lg px-2 py-1.5 outline-gray-200 text-sm" wire:model="floor">
                            <option value="">Kies een optie</option>
                            <option value="begane grond">Begane grond</option>
                            <option value="1e verdieping">1e Verdieping</option>
                        </select>
                    </div>
                </div>
                <hr class="my-4 border-gray-200">
                <div class="grid md:grid-cols-2 grid-cols-1 gap-2 mt-4">
                    <div class="flex flex-col gap-1" x-show="selectedType === 'room'">
                        <p class="text-sm text-gray-500/60">Kamer type</p>
                        <select required class="w-full mb-4 bg-gray-200 outline-2 focus:outline-blue-200 rounded-lg px-2 py-1.5 outline-gray-200 text-sm" wire:model="room_type">
                            <option value="">Kies een optie</option>
                            <option value="standard">Standaard</option>
                            <option value="deluxe">Deluxe</option>
                        </select>
                    </div>
                </div>
                <div class="flex flex-row justify-end gap-2">
                    <button type="submit" wire:click="updateRoomOrHall">Bewerk</button>
                </div>
            </div>
        </div>
    </template>

    <div class="mt-8">
        <table class="min-w-full bg-white rounded-lg ring-2 ring-gray-200">
            <thead>
                <tr>
                    <th class="px-2 sm:px-4 py-2 text-left text-sm md:text-md text-gray-600">Naam</th>
                    <th class="px-2 sm:px-4 py-2 text-left text-sm md:text-md text-gray-600">Type</th>
                    <th class="px-2 sm:px-4 py-2 text-left text-sm md:text-md text-gray-600">Capaciteit</th>
                    <th class="px-2 sm:px-4 py-2 text-left text-sm md:text-md text-gray-600">Prijs</th>
                    <th class="px-2 sm:px-4 py-2 text-left text-sm md:text-md text-gray-600">Verdieping</th>
                    <th class="px-2 sm:px-4 py-2 text-left text-sm md:text-md text-gray-600">Acties</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roomsandhalls as $roomorhall)
                <tr class="border-t border-gray-200 hover:bg-gray-50">
                    <td class="px-2 sm:px-4 py-2 text-[12px] md:text-md">{{ $roomorhall->name }}</td>
                    <td class="px-2 sm:px-4 py-2 text-[12px] md:text-md">{{ $roomorhall->type === 'room' ? 'Kamer' : 'Ruimte'; }}</td>
                    <td class="px-2 sm:px-4 py-2 text-[12px] md:text-md">{{ $roomorhall->capacity }}</td>
                    <td class="px-2 sm:px-4 py-2 text-[12px] md:text-md">€ {{ $roomorhall->price }}</td>
                    <td class="px-2 sm:px-4 py-2 text-[12px] md:text-md">{{ $roomorhall->floor }}</td>
                    <td class="px-2 sm:px-4 py-2 text-[12px] md:text-md"><span class="bg-blue-200 text-black px-2 py-1 rounded-md hover:bg-blue-300 hover:cursor-pointer" wire:click="editRoomOrHall({{ $roomorhall->id }})">Bewerken</span></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @if ($roomsandhalls->hasPages())
        <div class="mt-4">
            {{ $roomsandhalls->links('vendor.livewire.tailwind') }}
        </div>
        @endif
    </div>
</div>
