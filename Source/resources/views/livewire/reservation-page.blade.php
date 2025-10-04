<div x-data="{ showCreateModal: false, showEditModal: false, selectedType: $wire.entangle('type'), selectedRoomType: $wire.entangle('room_type') }" x-on:open-edit-modal.window="showEditModal = true">
    <div class="flex flex-row justify-between items-center">
        <div class="flex flex-col gap-1">
            <h1 class="md:text-4xl text-2xl font-bold">Reserveringen</h1>
            <p class="text-gray-500/60">Beheer Reserveringen.</p>
        </div>
        <button type="submit" wire:click="resetForm" @click="showCreateModal = true">Creëer</button>
    </div>

    <template x-if="showCreateModal">
        <div class="fixed inset-0 flex items-center justify-center z-50 backdrop-blur-sm">
            <div class="bg-white p-6 rounded-lg shadow-lg md:w-[800px] w-[500px] relative max-h-[90vh] overflow-y-auto">
                <button class="absolute top-2 right-3 text-gray-500 hover:text-gray-700 text-3xl hover:cursor-pointer"
                    @click="showCreateModal = false">&times;</button>
                <h2 class="text-xl font-bold mb-2">Nieuwe Reservering</h2>
                <p class="text-sm text-gray-500/60 mb-4">
                    Hier kunt u een nieuwe Reservering toevoegen, vul de volgende velden in en klik op "Creëer".
                </p>
                @if ($errors->any())
                    <div class="text-red-500 text-sm mb-4">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form wire:submit.prevent="createReservation" class="space-y-4">
                    @if ($currentStep === 0)
                        <div class="flex flex-col gap-2">
                            <label class="text-sm text-gray-500/60">Gast</label>
                            <select wire:model="guest_id"
                                class="w-full bg-gray-200 rounded-lg px-2 py-1.5 text-sm focus:outline-blue-200">
                                <option value="">Kies een gast</option>
                                @foreach ($guests as $guest)
                                    <option value="{{ $guest->id }}">{{ $guest->firstName }} {{ $guest->lastName }}
                                    </option>
                                @endforeach
                            </select>
                            <button wire:click="nextStep" type="button"
                                class="self-end bg-blue-200 text-black px-2 py-1 rounded-md hover:bg-blue-300 hover:cursor-pointer">
                                Continue
                            </button>
                        </div>
                    @endif
                    @if ($currentStep === 1)
                        <div class="flex flex-col gap-2">
                            <label class="text-sm text-gray-500/60">Type Reservering</label>
                            <select wire:model="reservation_type"
                                class="w-full bg-gray-200 rounded-lg px-2 py-1.5 text-sm focus:outline-blue-200">
                                <option value="">Kies een type</option>
                                <option value="Hotel">Hotel</option>
                                <option value="Conference">Conference</option>
                            </select>
                        </div>
                        <div class="flex flex-col gap-2" x-show="$wire.reservation_type === 'Hotel'">
                            <label class="text-sm text-gray-500/60">Aantal Kamers</label>
                            <input type="number" placeholder="Aantal Kamers" wire:model="rooms_amount"
                                class="w-full bg-gray-200 rounded-lg px-2 py-1.5 text-sm focus:outline-blue-200">
                        </div>
                        <div class="flex flex-col gap-2" x-show="$wire.reservation_type === 'Conference'">
                            <label class="text-sm text-gray-500/60">Opstelling</label>
                            <select wire:model="layout"
                                class="w-full bg-gray-200 rounded-lg px-2 py-1.5 text-sm focus:outline-blue-200">
                                <option value="">Kies een opstelling</option>
                                <option value="u-vorm">U-vorm</option>
                                <option value="blok">Blok</option>
                                <option value="school">School</option>
                                <option value="carre">Carré</option>
                                <option value="cabaret">Cabaret</option>
                                <option value="theater">Theater</option>
                                <option value="other">Overig</option>
                            </select>
                        </div>

                        <div class="flex justify-between mt-2">
                            <button wire:click="back" type="button"
                                class="bg-gray-300 text-black px-2 py-1 rounded-md hover:bg-blue-300 hover:cursor-pointer">Back</button>
                            <button wire:click="nextStep" type="button"
                                class="bg-blue-200 text-black px-2 py-1 rounded-md hover:bg-blue-300 hover:cursor-pointer">Continue</button>
                        </div>
                    @endif
                    @if ($currentStep === 2)
                        <div class="flex flex-col gap-2">
                            <label class="text-sm text-gray-500/60">Kamer / Ruimte</label>
                            <select wire:model="room_id"
                                class="w-full bg-gray-200 rounded-lg px-2 py-1.5 text-sm focus:outline-blue-200">
                                <option value="">Kies een kamer of ruimte</option>
                                @foreach ($rooms as $room)
                                    <option value="{{ $room->id }}">{{ $room->name }} ({{ $room->type }} -
                                        {{ $room->capacity }} pers.)</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex justify-between mt-2">
                            <button wire:click="back" type="button"
                                class="bg-gray-200 text-black px-2 py-1 rounded-md hover:bg-blue-300 hover:cursor-pointer">Back</button>
                            <button wire:click="nextStep" type="button"
                                class="bg-blue-200 text-black px-2 py-1 rounded-md hover:bg-blue-300 hover:cursor-pointer">Continue</button>
                        </div>
                    @endif
                    @if ($currentStep === 3)
                        <div class="flex flex-col gap-2">
                            <label class="text-sm text-gray-500/60">Aantal Personen</label>
                            <input type="number" placeholder="Aantal Personen" wire:model="amount"
                                class="w-full bg-gray-200 rounded-lg px-2 py-1.5 text-sm focus:outline-blue-200">
                        </div>
                        <div class="flex justify-between mt-2">
                            <button wire:click="back" type="button"
                                class="bg-gray-200 text-black px-2 py-1 rounded-md hover:bg-blue-300 hover:cursor-pointer">Back</button>
                            <button wire:click="nextStep" type="button"
                                class="bg-blue-200 text-black px-2 py-1 rounded-md hover:bg-blue-300 hover:cursor-pointer">Continue</button>
                        </div>
                    @endif
                    @if ($currentStep === 4)
                        <div class="flex flex-col gap-2">
                            <label class="text-sm text-gray-500/60">Incheck Datum & Tijd</label>
                            <div class="flex gap-2">
                                <input type="date" wire:model="check_in_date"
                                    class="w-full bg-gray-200 rounded-lg px-2 py-1.5 text-sm focus:outline-blue-200">
                                <input type="time" wire:model="check_in_time"
                                    class="w-full bg-gray-200 rounded-lg px-2 py-1.5 text-sm focus:outline-blue-200">
                            </div>
                        </div>

                        <div class="flex flex-col gap-2">
                            <label class="text-sm text-gray-500/60">Uitcheck Datum & Tijd</label>
                            <div class="flex gap-2">
                                <input type="date" wire:model="check_out_date"
                                    class="w-full bg-gray-200 rounded-lg px-2 py-1.5 text-sm focus:outline-blue-200">
                                <input type="time" wire:model="check_out_time"
                                    class="w-full bg-gray-200 rounded-lg px-2 py-1.5 text-sm focus:outline-blue-200">
                            </div>
                        </div>

                        <div class="flex flex-col gap-2">
                            <label for="extra_info" class="text-sm text-gray-500/60">Programma</label>
                            <textarea id="extra_info" wire:model="extra_info" rows="10" placeholder="Vul hier het programma in..."
                                class="w-full bg-gray-200 rounded-lg px-2 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-200 resize-none"></textarea>
                        </div>

                        <div class="flex justify-between mt-2">
                            <button wire:click="back" type="button"
                                class="bg-gray-200 text-black px-2 py-1 rounded-md hover:bg-blue-300 hover:cursor-pointer">Back</button>
                            <button wire:click="nextStep" type="button"
                                class="bg-blue-200 text-black px-2 py-1 rounded-md hover:bg-blue-300 hover:cursor-pointer">Continue</button>
                        </div>
                    @endif
                    @if ($currentStep === 5)
                        <div class="flex flex-col gap-4">
                            <h2 class="text-lg font-bold">Overzicht Reservering</h2>
                            <div class="bg-gray-100 p-4 rounded-lg space-y-2 text-sm">
                                <p><strong>Gast:</strong> {{ optional($guests->find($guest_id))->firstName }}
                                    {{ optional($guests->find($guest_id))->lastName }}</p>
                                <p><strong>Type Reservering:</strong> {{ $reservation_type }}</p>
                                @if ($reservation_type === 'Hotel')
                                    <p><strong>Aantal Kamers:</strong> {{ $rooms_amount }}</p>
                                @elseif($reservation_type === 'Conference')
                                    <p><strong>Opstelling:</strong> {{ $layout }}</p>
                                @endif
                                <p><strong>Kamer / Ruimte:</strong>
                                    {{ optional($rooms->find($room_id))->name ?? 'Geen geselecteerd' }}</p>
                                <p><strong>Aantal Personen:</strong> {{ $amount }}</p>
                                <p><strong>Check-in:</strong> {{ $check_in_date }} {{ $check_in_time }}</p>
                                <p><strong>Check-out:</strong> {{ $check_out_date }} {{ $check_out_time }}</p>
                                <p><strong>Programma:</strong> {{ $extra_info }}</p>
                            </div>
                            <div class="flex justify-between mt-4">
                                <button wire:click="back" type="button"
                                    class="bg-gray-300 text-black px-2 py-1 rounded-md hover:bg-blue-300 hover:cursor-pointer">Back</button>
                                <button type="submit" class="btn btn-primary flex items-center gap-2"
                                    wire:click="createReservation">
                                    <div wire:loading class="flex justify-center">
                                        <svg class="animate-spin size-4 text-blue-600"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10"
                                                stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor"
                                                d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z">
                                            </path>
                                        </svg>
                                    </div>
                                    Bevestig reservering
                                </button>
                            </div>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </template>


    <template x-if="showEditModal">
        <div :key="$wire.editId" class="fixed inset-0 flex items-center justify-center z-50 backdrop-blur-sm">
            <div class="bg-white p-6 rounded-lg shadow-lg md:w-200 w-130 relative">
                <button class="absolute top-2 right-3 text-gray-500 hover:text-gray-700 hover:cursor-pointer text-3xl"
                    @click="showEditModal = false">&times;</button>
                <h2 class="text-xl font-bold mb-4">Bewerk reservering</h2>
                <p class="text-sm text-gray-500/60">Hier kunt u een reservering bewerken, pas de velden aan en klik op
                    "Bewerk".</p>
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
                        <p class="text-sm text-gray-500/60">Gast</p>
                        <select wire:model="guest_id"
                            class="w-full mb-4 bg-gray-200 outline-2 focus:outline-blue-200 rounded-lg px-2 py-1.5 outline-gray-200 text-sm">
                            <option value="">Kies een gast</option>
                            @foreach ($guests as $guest)
                                <option value="{{ $guest->id }}">{{ $guest->firstName }} {{ $guest->lastName }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex flex-col gap-1">
                        <p class="text-sm text-gray-500/60">Type Reservering</p>
                        <select
                            class="w-full mb-4 bg-gray-200 outline-2 focus:outline-blue-200 rounded-lg px-2 py-1.5 outline-gray-200 text-sm"
                            wire:model="reservation_type">
                            <option value="">Kies een type</option>
                            <option value="Hotel">Hotel</option>
                            <option value="Conference">Conference</option>
                        </select>
                    </div>
                    <div class="flex flex-col gap-1" x-show="$wire.reservation_type === 'Hotel'">
                        <p class="text-sm text-gray-500 text-opacity-60">Aantal Kamers</p>
                        <input type="number"
                            class="w-full bg-gray-200 outline-2 focus:outline-blue-200 rounded-lg px-2 py-1.5 outline-gray-200 text-sm mb-4"
                            placeholder="Aantal Kamers" wire:model="rooms_amount" />
                    </div>

                    <div class="flex flex-col gap-1">
                        <p class="text-sm text-gray-500/60">Kamer / Ruimte</p>
                        <select wire:model="room_id"
                            class="w-full mb-4 bg-gray-200 outline-2 focus:outline-blue-200 rounded-lg px-2 py-1.5 outline-gray-200 text-sm">
                            <option value="">Kies een kamer of ruimte</option>
                            @foreach ($rooms as $room)
                                <option value="{{ $room->id }}">
                                    {{ $room->name }} ({{ $room->type }} - {{ $room->capacity }} pers.)
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex flex-col gap-1" x-show="$wire.reservation_type === 'Conference'">
                        <p class="text-sm text-gray-500 text-opacity-60">Opstelling</p>
                        <select
                            class="w-full mb-4 bg-gray-200 outline-2 focus:outline-blue-200 rounded-lg px-2 py-1.5 outline-gray-200 text-sm"
                            wire:model="layout">
                            <option value="">kies een opstelling</option>
                            <option value="u-vorm">U-vorm</option>
                            <option value="blok">Blok</option>
                            <option value="school">School</option>
                            <option value="carre">Carré</option>
                            <option value="cabaret">Cabaret</option>
                            <option value="theater">Theater</option>
                            <option value="other">Overig</option>
                        </select>
                    </div>

                    <div class="flex flex-col gap-1">
                        <p class="text-sm text-gray-500 text-opacity-60">Aantal Personen</p>
                        <input type="number"
                            class="w-full bg-gray-200 outline-2 focus:outline-blue-200 rounded-lg px-2 py-1.5 outline-gray-200 text-sm mb-4"
                            placeholder="Aantal Personen" wire:model="amount" />
                    </div>
                    <div class="flex flex-col gap-1">
                        <p class="text-sm text-gray-500/60">Incheck Datum & Tijd</p>
                        <div class="flex gap-2">
                            <input type="date"
                                class="w-full bg-gray-200 outline-2 focus:outline-blue-200 rounded-lg px-2 py-1.5 outline-gray-200 text-sm mb-4"
                                placeholder="Incheck Datum" wire:model="check_in_date" />
                            <input type="time"
                                class="w-full bg-gray-200 outline-2 focus:outline-blue-200 rounded-lg px-2 py-1.5 outline-gray-200 text-sm mb-4"
                                placeholder="Incheck Tijd" wire:model="check_in_time" />
                        </div>
                    </div>
                    <div class="flex flex-col gap-1">
                        <p class="text-sm text-gray-500/60">Uitcheck Datum & Tijd</p>
                        <div class="flex gap-2">
                            <input type="date"
                                class="w-full bg-gray-200 outline-2 focus:outline-blue-200 rounded-lg px-2 py-1.5 outline-gray-200 text-sm mb-4"
                                placeholder="Uitcheck Datum" wire:model="check_out_date" />
                            <input type="time"
                                class="w-full bg-gray-200 outline-2 focus:outline-blue-200 rounded-lg px-2 py-1.5 outline-gray-200 text-sm mb-4"
                                placeholder="Uitcheck Tijd" wire:model="check_out_time" />
                        </div>
                    </div>
                </div>

                <div class="flex flex-col gap-2">
                    <label for="extra_info" class="text-sm text-gray-500/60">Programma</label>
                    <textarea id="extra_info" wire:model="extra_info" rows="10" placeholder="Vul hier het programma in..."
                        class="w-full bg-gray-200 rounded-lg px-2 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-200 resize-none"></textarea>
                </div>

                <hr class="my-4 border-gray-200">
                <div class="flex flex-row justify-end gap-2">
                    <button type="submit" class="btn btn-primary flex items-center gap-2"
                        wire:click="updateReservation">
                        <div wire:loading class="flex justify-center">
                            <svg class="animate-spin size-4 text-blue-600" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10"
                                    stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z">
                                </path>
                            </svg>
                        </div>
                        Bewerk
                    </button>
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
                    <th class="px-2 sm:px-4 py-2 text-left text-sm md:text-md text-gray-600">Kamer / Ruimte</th>
                    <th class="px-2 sm:px-4 py-2 text-left text-sm md:text-md text-gray-600">Aantal personen</th>
                    <th class="px-2 sm:px-4 py-2 text-left text-sm md:text-md text-gray-600">Acties</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reservations as $reservation)
                    <tr class="border-t border-gray-200 hover:bg-gray-50">
                        <td class="px-2 sm:px-4 py-2 text-[12px] md:text-md">{{ $reservation->guest_name }}</td>
                        <td class="px-2 sm:px-4 py-2 text-[12px] md:text-md">{{ $reservation->reservation_type }}</td>
                        <td class="px-2 sm:px-4 py-2 text-[12px] md:text-md">
                            {{ $reservation->room ? $reservation->room->name : 'Geen kamer geselecteerd' }}</td>
                        <td class="px-2 sm:px-4 py-2 text-[12px] md:text-md">{{ $reservation->amount }}</td>
                        <td class="py-2 text-[12px] md:text-md">
                            <div class="flex gap-2">
                                <button type="button"
                                    class="bg-blue-200 text-black px-2 py-1 rounded-md hover:bg-blue-300 hover:cursor-pointer"
                                    wire:click="editReservation({{ $reservation->id }})">
                                    <div wire:loading wire:target="editReservation" wire:loading.attr="disabled"
                                        class="flex justify-center">
                                        <svg class="animate-spin size-4 text-blue-600"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10"
                                                stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor"
                                                d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z">
                                            </path>
                                        </svg>
                                    </div>
                                    Bekijk/Wijzig
                                </button>
                                <button wire:click="deleteReservation({{ $reservation->id }})"
                                    wire:loading.attr="disabled"
                                    class="bg-red-200 hover:bg-red-300 py-1 px-2 rounded-md cursor-pointer">
                                    <div wire:loading wire:target="deleteReservation" class="flex justify-center">
                                        <svg class="animate-spin size-4 text-red-600"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10"
                                                stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor"
                                                d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z">
                                            </path>
                                        </svg>
                                    </div>
                                    Verwijder
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $reservations->links() }}
    </div>
