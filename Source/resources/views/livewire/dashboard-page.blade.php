@section('title', 'B&B - Dashboard')

<div>
    <div class="flex flex-col gap-1">
        <h1 class="md:text-4xl text-2xl font-bold">Dashboard</h1>
        <p class="text-gray-500/60">Welkom terug, {{ Auth::user()->name }} 👋</p>
    </div>

    <div class="grid md:grid-cols-3 grid-cols-1 gap-6 mt-6">
        @livewire('components.stat-card', ['title' => 'Inkomen deze week', 'icon' => 'heroicon-o-currency-euro', 'value' => '€ ' . number_format($incomeThisWeek, 2, ',', '.')])
        @livewire('components.stat-card', ['title' => 'Aantal gasten', 'icon' => 'heroicon-o-user-group', 'value' => $guestCount])
        @livewire('components.stat-card', ['title' => 'Aantal werknemers', 'icon' => 'clarity-employee-line', 'value' => $employeesCount])
    </div>

    <div class="mt-6 grid md:grid-cols-2 grid-cols-1 gap-4">
        @livewire('components.chart.line', ['chartId' => 'line1', 'label' => 'Reserveringen deze week', 'data' => $reservationCountThisWeek['data'], 'labels' => $reservationCountThisWeek['labels']])
    </div>
</div>
