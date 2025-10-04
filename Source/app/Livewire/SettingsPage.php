<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingsPage extends Component
{
    protected $middleware = ['auth'];

    public $successMessage = null;

    public $current_password, $new_password_confirmation, $new_password;
    public $email;

    public function updatePassword()
    {
        $this->validate([
            'current_password' => ['required'],
            'new_password' => ['required', 'min:8', 'max:255', 'different:current_password', 'confirmed'],
        ]);

        $user = Auth::user();

        if (!Hash::check($this->current_password, $user->password)) {
            $this->addError('current_password', 'Oude wachtwoord is onjuist.');
            return;
        }

        $user->update([
            'password' => Hash::make($this->new_password),
        ]);

        Auth::logout();
        return redirect()->route('login');
    }

    public function updateInfo()
    {
        $this->validate([
            'email' => ['email', 'unique:users,email,' . Auth::id()]
        ]);

        $user = User::find(Auth::id());

        $user->update([
            'email' => $this->email ?? $user->email,
        ]);

        $this->successMessage = 'Gegevens succesvol bijgewerkt.';
    }

    public function mount()
    {
        $user = Auth::user();

        $this->email = $user->email;
    }

    public function render()
    {
        return view('livewire.settings-page');
    }
}
