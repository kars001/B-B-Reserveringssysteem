<?php

namespace App\Livewire;

use App\Models\RoomsAndHalls;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class RoomsPage extends Component
{
    // this is required for the pagination
    use WithPagination;

    public $name;
    public $type;
    public $capacity;
    public $room_type;
    public $price;
    public $floor;
    public $editId = null;
    // Set the pagination view to our custom tailwind view.
    public function paginationView()
    {
        return 'vendor.livewire.tailwind';
    }

    // Create a new room or hall.
    public function createRoomOrHall()
    {
        $this->validate([
            'name' => 'required|string|max:255|required',
            'type' => 'required|string|max:255|required',
            'capacity' => 'required|integer|min:1|max:30|required',
            'price' => 'required|numeric|min:0',
            'floor' => 'required|string|max:255|required',
            'room_type' => 'nullable|string|max:255',
        ]);

        $roomOrHall = RoomsAndHalls::create([
            'name' => $this->name,
            'type' => $this->type,
            'capacity' => $this->capacity,
            'price' => $this->price,
            'floor' => $this->floor,
            'room_type' => $this->room_type,
        ]);

        $this->resetPage('roomsandhalls');

        // Log the activity
        activity()
            ->causedBy(Auth::user())
            ->performedOn($roomOrHall)
            ->log('Kamer of ruimte aangemaakt: ' . $roomOrHall->name);

        return redirect('/rooms');
    }

    // Load room or hall data into the component properties for editing.
    public function editRoomOrHall($id)
    {
        $roomOrHall = RoomsAndHalls::findOrFail($id);

        $this->editId = $roomOrHall->id;
        $this->name = $roomOrHall->name;
        $this->type = $roomOrHall->type;
        $this->capacity = $roomOrHall->capacity;
        $this->price = $roomOrHall->price;
        $this->floor = $roomOrHall->floor;
        $this->room_type = $roomOrHall->room_type;

        $this->js('window.dispatchEvent(new CustomEvent("open-edit-modal"))');
    }

    // Update room or hall information.
    public function updateRoomOrHall()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1|max:30',
            'price' => 'required|numeric|min:0',
            'floor' => 'required|string|max:255',
            'room_type' => 'nullable|string|max:255',
        ]);

        $roomOrHall = RoomsAndHalls::findOrFail($this->editId);

        $roomOrHall->update([
            'name' => $this->name,
            'type' => $this->type,
            'capacity' => $this->capacity,
            'price' => $this->price,
            'floor' => $this->floor,
            'room_type' => $this->room_type,
        ]);

        $this->reset(['name', 'type', 'capacity', 'floor', 'room_type', 'editId']);
        $this->resetPage('roomsandhalls');
        return redirect('/rooms');
    }

    // Reset the form fields.
    public function resetForm()
    {
        $this->name = '';
        $this->type = '';
        $this->room_type = '';
        $this->capacity = '';
        $this->price = '';
        $this->floor = '';
    }

    // Render the rooms and halls view with pagination.
    public function render()
    {
        return view('livewire.rooms-page', [
            'roomsandhalls' => RoomsAndHalls::orderBy('created_at', 'desc')->paginate(10, ['*'], 'roomsandhalls')
        ]);
    }
}
