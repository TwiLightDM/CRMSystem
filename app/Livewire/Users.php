<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Collection;
use Livewire\Component;

class Users extends Component
{
    public function render()
    {
        $usersCount = User::query()->count();
        $users = User::all();
        $users = User::query()->find(1);
        return view('livewire.users', [
            'usersCount' => $usersCount,
            'users' => $users??Collection::make([]),
        ]);
    }
}
