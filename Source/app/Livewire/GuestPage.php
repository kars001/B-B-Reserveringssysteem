<?php

namespace App\Livewire;

use App\Models\Guest;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class GuestPage extends Component
{
    use WithPagination;

    public $firstName, $lastName, $adres, $email, $phonenumber, $comments;
    public $firstNameEdit, $lastNameEdit, $adresEdit, $emailEdit, $phonenumberEdit, $commentsEdit;
    public $editId;

    public function paginationView()
    {
        return 'vendor.livewire.tailwind';
    }

    public function createGuest()
    {
        $this->validate([
            'firstName' => ['required', 'max:35'],
            'lastName' => ['max:40'],
            'adres' => ['max:255'],
            'email' => ['max:255'],
            'phonenumber' => ['max:255'],
            'comments' => ['max:1000'],
        ]);

        $guest = Guest::create([
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'adres' => $this->adres,
            'email' => $this->email,
            'phonenumber' => $this->phonenumber,
            'comments' => $this->comments,
        ]);

        $this->reset();

        activity()
            ->causedBy(Auth::user())
            ->performedOn($guest)
            ->log('Een nieuwe gast is aangemaakt: ' . $guest->firstName . ' ' . $guest->lastName);

        $this->dispatch('close-modal');
    }

    public function editGuest($id)
    {
        $guest = Guest::findOrFail($id);

        $this->editId = $guest->id;
        $this->firstNameEdit = $guest->firstName;
        $this->lastNameEdit = $guest->lastName;
        $this->adresEdit = $guest->adres;
        $this->emailEdit = $guest->email;
        $this->phonenumberEdit = $guest->phonenumber;
        $this->commentsEdit = $guest->comments;

        $this->js('window.dispatchEvent(new CustomEvent("open-edit-modal"))');
    }

    public function updateGuest()
    {
        $this->validate([
            'firstNameEdit' => ['required', 'max:35'],
            'lastNameEdit' => ['max:40'],
            'adresEdit' => ['max:255'],
            'emailEdit' => ['max:255'],
            'phonenumberEdit' => ['max:255'],
            'commentsEdit' => ['max:1000'],
        ]);

        $guest = Guest::findOrFail($this->editId);

        $guest->update([
            'firstName' => $this->firstNameEdit,
            'lastName' => $this->lastNameEdit,
            'adres' => $this->adresEdit,
            'email' => $this->emailEdit,
            'phonenumber' => $this->phonenumberEdit,
            'comments' => $this->commentsEdit,
        ]);

        $this->reset(['editId', 'firstNameEdit', 'lastNameEdit', 'adresEdit', 'emailEdit', 'phonenumberEdit', 'commentsEdit']);

        activity()
            ->causedBy(Auth::user())
            ->performedOn($guest)
            ->log('Een gast is bewerkt: ' . $guest->firstName . ' ' . $guest->lastName);

        $this->resetPage('guests');
        return redirect('/guests');
    }

    public function deleteGuest($id)
    {
        $guest = Guest::findOrFail($id);
        $guest->delete();
    }

    public function resetForm()
    {
        $this->firstNameEdit = '';
        $this->lastNameEdit = '';
        $this->adresEdit = '';
        $this->emailEdit = '';
        $this->phonenumberEdit = '';
        $this->commentsEdit = '';
    }

    public function render()
    {
        $guests = guest::orderBy('id', 'desc')->paginate(10);
        
        return view('livewire.guest-page', [
            'guests' => $guests
        ]);
    }
}
