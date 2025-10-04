<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\License;
use Illuminate\Support\Str;
use Spatie\Activitylog\Models\Activity;
use Livewire\Attributes\Validate;

class AdminPage extends Component
{
    // this is required for the pagination
    use WithPagination;

    // Validation rules for name
    #[Validate('required|string|max:255')]
    public $name;

    // Validation rules for email
    #[Validate('required|email|max:255')]
    public $email;

    // Set the pagination view to our custom tailwind view.
    public function paginationView()
    {
        return 'vendor.livewire.tailwind';
    }

    // Create a new license.
    public function createLicense()
    {
        $license = License::create([
            'license_code' => Str::random(16),
        ]);

        $this->dispatch('license-created', $license);
    }

    // Delete a license.
    public function deleteLicense($id)
    {
        $license = License::find($id);
        if ($license) {
            $license->delete();
            $this->resetPage('licenses');
            return redirect('/admin');
        }
    }

    // Delete a user.
    public function deleteUser($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            $this->resetPage('users');
            return redirect('/admin');
        }
    }

    // Load user data into the component properties for editing.
    public function loadUser($id)
    {
        $user = User::find($id);
        if ($user) {
            $this->name = $user->name;
            $this->email = $user->email;
        }
    }

    // Update user information.
    public function updateUser($id)
    {
        $this->validate();

        $user = User::find($id);
        if ($user) {
        $user->update([
                'name' => $this->name,
                'email' => $this->email,
            ]);
        }

        $this->resetPage('users');
        return redirect('/admin');
    }   

    // We check if the user is authenticated and has the admin role.
    // If this Fails then we redirect to login. 
    public function mount()
    {
        if (!Auth::check() || !Auth::user()->hasRole('admin')) {
            return redirect('login');
        }
    }

    // We pass variables from the database with the pagination.
    public function render()
    {
        return view('livewire.admin-page', [
            'users' => User::paginate(10, ['*'], 'users'),
            'licenses' => License::orderBy('created_at', 'desc')->paginate(10, ['*'], 'licenses'),
            'activities' => Activity::with('causer')->orderBy('created_at', 'desc')->paginate(10, ['*'], 'activities')
        ]);
    }
}
