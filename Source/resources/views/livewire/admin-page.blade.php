<div x-data="{ tab: 'users' }">
    <div class="flex flex-col gap-1">
        <h1 class="md:text-4xl text-2xl font-bold">Toegang Beheren</h1>
        <p class="text-gray-500/60">Beheer gebruikers en hun toegang tot het systeem.</p>
    </div>
    <div class="mt-8">
        <div class="flex flex-row justify-between">
            <div class="flex gap-2 mb-6">
                <button @click="tab = 'users'" :class="tab === 'users' ? 'font-bold text-black bg-blue-200' : ''" class="md:py-2 md:px-4 py-1 px-1 rounded-md hover:bg-blue-300 hover:cursor-pointer">Gebruikers</button>
                <button @click="tab = 'licenses'" :class="tab === 'licenses' ? 'font-bold text-black bg-blue-200' : ''" class="md:py-2 md:px-4 py-1 px-1 rounded-md hover:bg-blue-300 hover:cursor-pointer">Licenties</button>
                <button @click="tab = 'logs'" :class="tab === 'logs' ? 'font-bold text-black bg-blue-200' : ''" class="md:py-2 md:px-4 py-1 px-1 rounded-md hover:bg-blue-300 hover:cursor-pointer">Logs</button>

            </div>
            <div x-show="tab === 'licenses'" class="flex items-end mb-6">
                <button class="bg-blue-200 text-black md:py-2 md:px-4 py-1 px-1 rounded-md hover:bg-blue-300 hover:cursor-pointer" wire:click="createLicense">Creeër License</button>
            </div>
        </div>

        <div x-show="tab === 'users'">
            <table class="min-w-full bg-white rounded-lg ring-2 ring-gray-200">
                <thead>
                    <tr>
                        <th class="px-2 sm:px-4 py-2 text-left text-sm md:text-md text-gray-600">Naam</th>
                        <th class="px-2 sm:px-4 py-2 text-left text-sm md:text-md text-gray-600">Email</th>
                        <th class="px-2 sm:px-4 py-2 text-left text-sm md:text-md text-gray-600">Gecreëerd op</th>
                        <th class="px-2 sm:px-4 py-2 text-left text-sm md:text-md text-gray-600">Acties</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr class="border-t border-gray-200 hover:bg-gray-50">
                        <td class="px-2 sm:px-4 py-2 text-[12px] md:text-md">{{ $user->name }}</td>
                        <td class="px-2 sm:px-4 py-2 text-[12px] md:text-md">{{ $user->email }}</td>
                        <td class="px-2 sm:px-4 py-2 text-[12px] md:text-md">{{ $user->created_at->format('d-m-Y') }}</td>
                        <td class="px-2 sm:px-4 py-2 text-[12px] md:text-md">
                            @if (auth()->id() !== $user->id)
                                <div x-data="{ showConfirm: false, confirmInput: '' }" class="inline-block">
                                    <x-heroicon-o-trash class="size-4 hover:cursor-pointer text-red-500" @click="showConfirm = true; confirmInput = ''" />
                                    <div x-show="showConfirm" x-transition class="fixed inset-0 flex items-center justify-center z-50 backdrop-blur-sm" style="display: none;">
                                        <div class="bg-white p-6 rounded shadow-lg md:w-100 w-120">
                                            <h2 class="text-lg font-bold mb-2">Bevestig Verwijderen</h2>
                                            <p class="mb-2 text-sm">Typ <span class='font-mono bg-gray-100 px-1 rounded'>{{ $user->email }}</span> om te bevestigen dat je deze gebruiker wilt verwijderen.</p>
                                            <input type="text" class="w-full rounded px-2 py-1 mb-4" placeholder="Typ hier..." x-model="confirmInput" />
                                            <div class="flex items-center justify-end gap-2">
                                                <button class="bg-gray-200 text-black px-4 py-2 rounded-md hover:bg-gray-300" @click="showConfirm = false">Annuleren</button>
                                                <template x-if="confirmInput === '{{ $user->email }}'">
                                                    <button class="bg-blue-200 text-black px-4 py-2 rounded-md hover:bg-blue-300" @click="$wire.deleteUser({{ $user->id }}); showConfirm = false;">Verwijder</button>
                                                </template>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="flex flex-row items-center gap-2">
                                    <span class="md:block hidden text-red-black text-sm md:py-1 md:px-2 py-0.5 px-1 bg-red-500/30 rounded-full">Niet mogelijk</span>
                                    <div x-data="{ show: false }" class="relative">
                                        <x-heroicon-o-question-mark-circle class="size-4 text-gray-500 hover:cursor-pointer" @mouseenter="show = true" @mouseleave="show = false" @click="show = !show" />
                                        <div x-show="show" x-transition @click.away="show = false" class="absolute right-0 translate-x-0 md:right-1/2 md:-translate-x-1/2 mt-2 w-56 bg-gray-800 text-white text-xs rounded-md shadow-lg p-2 z-10" style="display: none;">
                                            Deze actie is niet mogelijk omdat je geen admin of jezelf kunt verwijderen.
                                        </div>
                                    </div>
                                </div>
                            @endif
                                <div x-data="{ showUpdateForm: false }" class="inline-block">
                                    <button class="bg-blue-200 hover:bg-blue-300 py-1 px-2 rounded-md cursor-pointer"
                                        @click="$wire.loadUser({{ $user->id }}); showUpdateForm = true">
                                        Update
                                    </button>
                                    <div x-show="showUpdateForm" x-transition class="fixed inset-0 flex items-center justify-center z-50 backdrop-blur-sm" style="display: none;">
                                        <form wire:submit="updateUser({{ $user->id }})">
                                            @csrf   
                                            <div class="bg-white p-6 rounded shadow-lg md:w-100 w-120">
                                                <h2 class="text-lg font-bold mb-2">Update Gebruiker</h2>
                                                <div class="grid grid-cols-1 gap-1">
                                                    <label for="name">Name</label>
                                                    <input wire:model.defer="name" type="text" class="w-full rounded px-2 py-1 mb-4" />
                                                    @error('name')
                                                        <span class="text-sm text-red-500">{{ $message }}</span>
                                                    @enderror
                                                    <label for="email">Email</label>
                                                    <input wire:model.defer="email" type="email" class="w-full rounded px-2 py-1 mb-4" />
                                                    @error('email')
                                                        <span class="text-sm text-red-500">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="flex items-center justify-end gap-2">
                                                    <button class="bg-gray-200 text-black px-4 py-2 rounded-md hover:bg-gray-300" @click="showUpdateForm = false">Annuleren</button>
                                                    <button class="bg-blue-200 text-black px-4 py-2 rounded-md hover:bg-blue-300" type="submit">Update</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if ($users->hasPages())
            <div class="mt-4">
                {{ $users->links('vendor.livewire.tailwind') }}
            </div>
            @endif
        </div>
        <div x-show="tab === 'licenses'">
            <table class="min-w-full bg-white rounded-lg ring-2 ring-gray-200">
                <thead>
                    <tr>
                        <th class="px-2 sm:px-4 py-2 text-left text-sm md:text-md text-gray-600">License Code</th>
                        <th class="px-2 sm:px-4 py-2 text-left text-sm md:text-md text-gray-600">Gecreëerd op</th>
                        <th class="px-2 sm:px-4 py-2 text-left text-sm md:text-md text-gray-600">Acties</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($licenses as $license)
                    <tr class="border-t border-gray-200 hover:bg-gray-50">
                        <td class="px-2 sm:px-4 py-2 text-[12px] md:text-md">{{ $license->license_code }}</td>
                        <td class="px-2 sm:px-4 py-2 text-[12px] md:text-md">{{ $license->created_at->format('d-m-Y') }}</td>

                        <td class="px-2 sm:px-4 py-2 text-[12px] md:text-md">
                            <div x-data="{ showConfirm: false, confirmInput: '' }" class="inline-block">
                                <x-heroicon-o-trash class="size-4 hover:cursor-pointer text-red-500" @click="showConfirm = true; confirmInput = ''" />
                                <div x-show="showConfirm" x-transition class="fixed inset-0 flex items-center justify-center z-50 backdrop-blur-sm" style="display: none;">
                                    <div class="bg-white p-6 rounded shadow-lg md:w-100 w-120">
                                        <h2 class="text-lg font-bold mb-2">Bevestig Verwijderen</h2>
                                        <p class="mb-2 text-sm">Typ <span class='font-mono bg-gray-100 px-1 rounded'>{{ $license->license_code }}</span> om te bevestigen dat je deze licentie wilt verwijderen.</p>
                                        <input type="text" class="w-full rounded px-2 py-1 mb-4" placeholder="Typ hier..." x-model="confirmInput" />
                                        <div class="flex items-center justify-end gap-2">
                                            <button class="bg-gray-200 text-black px-4 py-2 rounded-md hover:bg-gray-300" @click="showConfirm = false">Annuleren</button>
                                            <template x-if="confirmInput === '{{ $license->license_code }}'">
                                                <button class="bg-blue-200 text-black px-4 py-2 rounded-md hover:bg-blue-300" @click="$wire.deleteLicense({{ $license->id }}); showConfirm = false;">Verwijder</button>
                                            </template>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                @if ($licenses->hasPages())
                {{ $licenses->links('vendor.livewire.tailwind') }}
                @endif
            </div>
        </div>
        <div x-show="tab === 'logs'">
            <table class="min-w-full bg-white rounded-lg ring-2 ring-gray-200">
                <thead>
                    <tr>
                        <th class="px-2 sm:px-4 py-2 text-left text-sm md:text-md text-gray-600">Actie Door</th>
                        <th class="px-2 sm:px-4 py-2 text-left text-sm md:text-md text-gray-600">Beschrijving</th>
                        <th class="px-2 sm:px-4 py-2 text-left text-sm md:text-md text-gray-600">Uitgevoerd op</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($activities as $activity)
                    <tr class="border-t border-gray-200 hover:bg-gray-50">
                        <td class="px-2 sm:px-4 py-2 text-[12px] md:text-md">{{ $activity->causer?->name }}</td>
                        <td class="px-2 sm:px-4 py-2 text-[12px] md:text-md">{{ $activity->description }}</td>
                        <td class="px-2 sm:px-4 py-2 text-[12px] md:text-md">{{ $activity->created_at }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @if ($activities->hasPages())
            <div class="mt-4">
                {{ $activities->links('vendor.livewire.tailwind') }}
            </div>
            @endif
        </div>
    </div>
</div>
