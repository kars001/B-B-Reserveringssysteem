<!-- Sidebar -->
<div @click.away="open = false" class="flex flex-col w-full md:w-64 text-gray-700 bg-white flex-shrink-0 md:h-screen"
    x-data="{ open: false }">
    <!-- Sidebar header -->
    <div class="flex-shrink-0 px-8 py-4 flex flex-row items-center justify-between">
        <div x-data="{
            show: false,
            toggle() {
                this.show = true;
                this.$nextTick(() => {
                    const v = this.$refs.video;
                    v.currentTime = 0;
                    v.play();
                    v.onended = () => this.show = false;
                });
            },
            close() {
                this.show = false;
                const v = this.$refs.video;
                v.pause();
                v.currentTime = 0;
            }
        }" @click.outside="close()">

            <button class="cursor-pointer text-lg font-semibold text-gray-900 rounded-lg">
                Bed <span @click="toggle()">&</span> Business
            </button>

            <template x-if="show">
                <div style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 9999;">
                    <video x-ref="video" src="{{ asset('storage/reef.mp4') }}" autoplay playsinline
                        style="width: 600px; height: 600px; object-fit: cover;" @click="close()"></video>
                </div>
            </template>
        </div>

        <!-- Mobile menu button -->
        <button class="rounded-lg md:hidden" @click="open = !open">
            <svg fill="none" viewBox="0 0 24 24" class="w-6 h-6" stroke="currentColor">
                <!-- Open (Hamburger) -->
                <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16" />
                <!-- Close (x) -->
                <path x-show="open" fill-rule="evenodd" d="M6 18L18 6M6 6l12 12" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        </button>
    </div>
    <!-- Navigation -->
    <nav :class="{ 'flex': open, 'hidden': !open }" class="md:flex px-4 md:pb-0 flex flex-col h-full justify-between">
        <div>
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" icon="home">Dashboard</x-nav-link>
            <x-nav-link :href="route('reservations')" :active="request()->routeIs('reservations')" icon="calendar-date-range">Reserveringen</x-nav-link>
            <x-nav-link :href="route('guests')" :active="request()->routeIs('guests')" icon="users">Gasten</x-nav-link>
            <x-nav-link :href="route('rooms')" :active="request()->routeIs('rooms')" icon="key">Kamers en ruimtes</x-nav-link>
            @hasrole('admin')
                <x-nav-link :href="route('admin')" :active="request()->routeIs('admin')" icon="shield-check">Admin Paneel</x-nav-link>
            @endhasrole
        </div>
        <div class="pb-3">
            <x-nav-link :href="route('settings')" :active="request()->routeIs('settings')" icon="cog-6-tooth">Instellingen</x-nav-link>
            <x-nav-link :href="route('logout')" :active="request()->routeIs('logout')"
                icon="arrow-right-start-on-rectangle">Uitloggen</x-nav-link>
        </div>
    </nav>
</div>
