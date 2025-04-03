<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class Users extends Component
{
    public $name, $email, $password, $userId;
    public $isEditing = false;

    public function render()
    {
        return view('livewire.users', [
            'users' => User::all(),
        ]);
    }

    public function createUser()
    {
        $validated = $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:Users,email',
            'password' => 'nullable|string|max:255',
        ]);

        $validated['date_of_creation'] = now();

        User::create($validated);

        $this->resetFields();
        session()->flash('message', 'Юзер успешно добавлен.');
    }

    public function editUser($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->isEditing = true;
    }

    public function updateUser()
    {
        $validated = $this->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:Users,email,{$this->userId}",
            'password' => 'nullable|string|max:255',

        ]);

        $User = User::withTrashed()->findOrFail($this->userId);
        $User->update($validated);

        $this->resetFields();
        session()->flash('message', 'Юзер успешно обновлен.');
    }

    public function deleteUser($id)
    {
        User::findOrFail($id)->delete();
        session()->flash('message', 'Юзер был помечен как удалённый.');
    }

    public function restoreUser($id)
    {
        User::withTrashed()->findOrFail($id)->restore();
        session()->flash('message', 'Юзер успешно восстановлен.');
    }

    public function forceDeleteUser($id)
    {
        User::withTrashed()->findOrFail($id)->forceDelete();
        session()->flash('message', 'Юзер полностью удалён.');
    }

    private function resetFields()
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->userId = null;
        $this->isEditing = false;
    }
}
