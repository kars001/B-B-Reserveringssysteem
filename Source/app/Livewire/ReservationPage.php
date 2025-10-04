<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Reservations;
use App\Models\Guest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReservationHotelConfirmEmail;
use App\Mail\ReservationConferenceConfirmEmail;
use App\Models\RoomsAndHalls;
use Carbon\Carbon;
use DateTime;

Carbon::setLocale('nl');

class ReservationPage extends Component
{
    use WithPagination;
    public $reservation_id;
    public $guest_name;
    public $reservation_type;
    public $amount;
    public $check_in_date;
    public $check_out_date;
    public $check_in_time;
    public $check_out_time;
    public $rooms_amount;
    public $layout;
    public $guest_id;
    public $guests;
    public $room_id;
    public $rooms;
    public $extra_info;

    public $currentStep = 0;

    public function nextStep()
    {
        switch ($this->currentStep) {
            case 0:
                $this->validate([
                    'guest_id' => 'required|exists:guests,id',
                ]);
                break;

            case 1:
                $this->validate([
                    'reservation_type' => 'required|string|max:255',
                ]);

                if ($this->reservation_type === 'Hotel') {
                    $this->validate([
                        'rooms_amount' => 'required|numeric|min:1',
                    ]);
                } elseif ($this->reservation_type === 'Conference') {
                    $this->validate([
                        'layout' => 'required|in:u-vorm,blok,school,carre,cabaret,theater,other',
                    ]);
                }
                break;

            case 2:
                $this->validate([
                    'room_id' => 'required|exists:rooms_and_halls,id',
                ]);
                break;

            case 3:
                $this->validate([
                    'amount' => 'required|numeric|min:1',
                ]);
                break;

            case 4:
                $this->validate([
                    'check_in_date' => 'required|date|after_or_equal:today',
                    'check_out_date' => 'required|date|after_or_equal:check_in_date',
                    'check_in_time' => 'required|date_format:H:i',
                    'check_out_time' => 'required|date_format:H:i',
                ]);
                break;
        }

        if ($this->currentStep < 5) {
            $this->currentStep++;
        }
    }


    public function back()
    {
        $this->currentStep--;
    }

    public function updating($property)
    {
        if ($property !== 'page') {
            $this->resetPage();
        }
    }

    public function createReservation()
    {
        $this->validate([
            'amount' => 'nullable|numeric|min:0',
            'rooms_amount' => 'nullable|numeric|min:1',
            'layout' => 'required_if:reservation_type,Conference|in:u-vorm,blok,school,carre,cabaret,theater,other',
            'room_id' => 'nullable|exists:rooms_and_halls,id',
        ]);

        $reservation = Reservations::create([
            'guest_id' => $this->guest_id,
            'guest_name' => Guest::find($this->guest_id)->firstName . ' ' . Guest::find($this->guest_id)->lastName,
            'reservation_type' => $this->reservation_type,
            'amount' => $this->amount,
            'check_in_date' => $this->check_in_date,
            'check_out_date' => $this->check_out_date,
            'check_in_time' => $this->check_in_time,
            'check_out_time' => $this->check_out_time,
            'rooms_amount' => $this->rooms_amount,
            'layout' => $this->layout ?: 'other',
            'room_id' => $this->room_id,
            'extra_info' => $this->extra_info,
        ]);

        $guestEmail = optional($reservation->guest)->email;
        $checkInDateTime = Carbon::parse($this->check_in_date . ' ' . $this->check_in_time);
        $checkOutDateTime = Carbon::parse($this->check_out_date . ' ' . $this->check_out_time);

        if (!empty($guestEmail)) {
            if ($this->reservation_type == 'Conference') {
                Mail::to($guestEmail)->send(new ReservationConferenceConfirmEmail([
                    'firstName' => Guest::find($this->guest_id)->firstName,
                    'lastName' => Guest::find($this->guest_id)->lastName,
                    'phoneNumber' => Guest::find($this->guest_id)->phoneNumber,
                    'email' => Guest::find($this->guest_id)->email,
                    'guestAmount' => $this->amount,
                    'checkInDate' => $checkInDateTime->translatedFormat('l d F') . ' om ' . $checkInDateTime->format('H:i'),
                    'checkOutDate' => $checkOutDateTime->translatedFormat('l d F') . ' om ' . $checkOutDateTime->format('H:i'),
                    'causer' => Auth::user()->name,
                    'extra_info' => $this->extra_info,
                ]));
            } elseif ($this->reservation_type == 'Hotel') {
                $datetime1 = new DateTime($checkInDateTime);
                $datetime2 = new DateTime($checkOutDateTime);
                $nights = $datetime1->diff($datetime2)->format('%a');

                Mail::to($guestEmail)->send(new ReservationHotelConfirmEmail([
                    'firstName' => Guest::find($this->guest_id)->firstName,
                    'lastName' => Guest::find($this->guest_id)->lastName,
                    'checkInDate' => $checkInDateTime->translatedFormat('l d F') . ' om ' . $checkInDateTime->format('H:i'),
                    'checkOutDate' => $checkOutDateTime->translatedFormat('l d F') . ' om ' . $checkOutDateTime->format('H:i'),
                    'roomType' => RoomsAndHalls::find($this->room_id)->room_type,
                    'roomPrice' => RoomsAndHalls::find($this->room_id)->price,
                    'nights' => $nights,
                ]));
            }
        }


        activity()
            ->causedBy(Auth::user())
            ->performedOn($reservation)
            ->log('Reservering aangemaakt voor: ' . $reservation->guest_name);

        $this->reset(['guest_id', 'guest_name', 'reservation_type', 'amount', 'check_in_date', 'check_out_date', 'check_in_time', 'check_out_time', 'layout', 'reservation_id', 'room_id', 'extra_info']);

        return redirect('/reservations');
    }

    public function updateReservation()
    {
        $this->validate([
            'reservation_id' => 'required|exists:reservations,id',
            'guest_id' => 'required|exists:guests,id',
            'guest_name' => 'required|string|max:255',
            'reservation_type' => 'required|string|max:255',
            'amount' => 'nullable|numeric|min:0',
            'check_in_date' => 'required|date|after_or_equal:today',
            'check_out_date' => 'required|date|after_or_equal:check_in_date',
            'check_in_time' => 'nullable|date_format:H:i',
            'check_out_time' => 'nullable|date_format:H:i',
            'rooms_amount' => 'nullable|numeric|min:1',
            'layout' => 'required_if:reservation_type,Conference|in:u-vorm,blok,school,carre,cabaret,theater,other',
            'room_id' => 'nullable|exists:rooms_and_halls,id',
            'extra_info' => 'nullable|string',
        ]);

        if ($this->reservation_id) {
            $reservation = Reservations::find($this->reservation_id);
            if ($reservation) {
                $reservation->update([
                    'guest_id' => $this->guest_id,
                    'guest_name' => Guest::find($this->guest_id)->firstName . ' ' . Guest::find($this->guest_id)->lastName,
                    'reservation_type' => $this->reservation_type,
                    'amount' => $this->amount,
                    'check_in_date' => $this->check_in_date,
                    'check_out_date' => $this->check_out_date,
                    'check_in_time' => $this->check_in_time,
                    'check_out_time' => $this->check_out_time,
                    'rooms_amount' => $this->rooms_amount,
                    'layout' => $this->layout ?? 'other',
                    'room_id' => $this->room_id,
                    'extra_info' => $this->extra_info,
                ]);

                activity()
                    ->causedBy(Auth::user())
                    ->performedOn($reservation)
                    ->log('Reservering bijgewerkt voor: ' . $reservation->guest_name);
            }
        }

        $this->reset(['guest_id', 'guest_name', 'reservation_type', 'amount', 'check_in_date', 'check_out_date', 'check_in_time', 'check_out_time', 'layout', 'reservation_id', 'room_id', 'extra_info']);

        return redirect('/reservations');
    }

    public function deleteReservation($id)
    {
        $reservation = Reservations::find($id);
        if ($reservation) {
            $reservation->delete();

            activity()
                ->causedBy(Auth::user())
                ->performedOn($reservation)
                ->log('Reservering verwijderd voor: ' . $reservation->guest_name);
        }

        return redirect('/reservations');
    }

    public function editReservation($id)
    {
        $reservation = Reservations::find($id);
        if ($reservation) {
            $this->reservation_id = $reservation->id;
            $this->guest_id = $reservation->guest_id;
            $this->guest_name = $reservation->guest_name;
            $this->reservation_type = $reservation->reservation_type;
            $this->amount = $reservation->amount;
            $this->check_in_date = $reservation->check_in_date;
            $this->check_out_date = $reservation->check_out_date;
            $this->check_in_time = $reservation->check_in_time;
            $this->check_out_time = $reservation->check_out_time;
            $this->rooms_amount = $reservation->rooms_amount;
            $this->layout = $reservation->layout;
            $this->room_id = $reservation->room_id;
            $this->extra_info = $reservation->extra_info;

            $this->js('window.dispatchEvent(new CustomEvent("open-edit-modal"))');
        }
    }

    public function resetForm()
    {
        $this->reservation_id = '';
        $this->guest_id = '';
        $this->guest_name = '';
        $this->reservation_type = '';
        $this->amount = '';
        $this->check_in_date = '';
        $this->check_out_date = '';
        $this->check_in_time = '';
        $this->check_out_time = '';
        $this->rooms_amount = '';
        $this->layout = '';
        $this->room_id = '';
        $this->extra_info = '';
        $this->currentStep = 0;
    }

    public function softDeleteReservations()
    {
        $timespan = now()->subMonth(1);
        Reservations::where('created_at', '<', $timespan)->delete();
    }

    public function render()
    {
        $this->softDeleteReservations();

        $reservations = Reservations::orderBy('created_at', 'desc')->paginate(10);

        $reservedRoomIds = Reservations::pluck('room_id')->filter()->toArray();

        if ($this->reservation_type === 'Hotel') {
            $this->rooms = RoomsAndHalls::where('type', 'room')->whereNotIn('id', $reservedRoomIds)->orderBy('name')->get();
        } elseif ($this->reservation_type === 'Conference') {
            $this->rooms = RoomsAndHalls::where('type', 'hall')->whereNotIn('id', $reservedRoomIds)->orderBy('name')->get();
        } else {
            $this->rooms = collect();
        }
        if ($this->reservation_id) {
            $this->guests = Guest::orderBy('firstName')->get();
        } else {
            $guestIdsWithReservations = Reservations::pluck('guest_id')->toArray();
            $this->guests = Guest::whereNotIn('id', $guestIdsWithReservations)
                ->orderBy('firstName')
                ->get();
        }
        return view('livewire.reservation-page', [
            'reservations' => $reservations,
            'guests' => $this->guests,
            'rooms' => $this->rooms,
        ]);
    }
}
