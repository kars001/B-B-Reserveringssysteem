<?php

namespace App\Livewire;

use App\Models\Guest;
use App\Models\Reservations;
use App\Models\RoomsAndHalls;
use App\Models\User;
use Flowframe\Trend\Trend;
use Livewire\Component;
use Carbon\Carbon;

class DashboardPage extends Component
{
    protected $middleware = ['auth'];

    // Get reservations per day for the current week.
    public function reservationsThisWeek()
    {
        $reservations = Trend::query(Reservations::query())
            ->between(
                start: now()->startOfWeek(),
                end: now()->endOfWeek()
            )
            ->perDay()
            ->count();

        $weeklyReservations = [
            'labels' => collect($reservations)->map(fn($item) => Carbon::parse($item->date)->locale('nl')->isoFormat('dd'))->toArray(),
            'data' => collect($reservations)->map(fn($item) => $item->aggregate)->toArray(),
        ];

        return $weeklyReservations;
    }

    // Calculate total income for the current week.
    public function incomeThisWeek()
    {
        $reservationsThisWeek = Reservations::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->get();

        $totalIncome = $reservationsThisWeek->sum(function ($reservation) {
            $singleRoomPrice = RoomsAndHalls::where('id', $reservation->room_id)->value('price');
            return $reservation->amount + $singleRoomPrice;
        });

        return $totalIncome;
    }

    // Render the dashboard view with the variables.
    public function render()
    {
        $reservationCountThisWeek = $this->reservationsThisWeek();
        $incomeThisWeek = $this->incomeThisWeek();
        $guestCount = Guest::count();
        $employeesCount = User::count();

        return view('livewire.dashboard-page', [
            'reservationCountThisWeek' => $reservationCountThisWeek,
            'incomeThisWeek' => $incomeThisWeek,
            'guestCount' => $guestCount,
            'employeesCount' => $employeesCount,
        ]);
    }
}
