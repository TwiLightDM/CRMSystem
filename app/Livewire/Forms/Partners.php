<?php

namespace App\Livewire;

use App\Models\Partner;
use Livewire\Component;

class Partners extends Component

{
    public $name, $email, $phone, $description, $status, $partnerId;
    public $isEditing = false;

    public function render()
    {
        return view('livewire.partners', [
            'partners' => Partner::all(),
        ]);
    }

    public function createPartner()
    {
        $validated = $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:partners,email',
            'phone' => 'nullable|string|max:20',
            'description' => 'nullable|string',
            'status' => 'required|string|in:сотрудничаем, прекратили сотрудничество',
        ]);

        $validated['date_of_cooperation'] = now();

        Partner::create($validated);

        $this->resetFields();
        session()->flash('message', 'Партнер успешно добавлен.');
    }

    public function editPartner($id)
    {
        $partner = Partner::withTrashed()->findOrFail($id);
        $this->PartnerId = $partner->id;
        $this->name = $partner->name;
        $this->email = $partner->email;
        $this->phone = $partner->phone;
        $this->description = $partner->description;
        $this->status = $partner->status;
        $this->isEditing = true;
    }

    public function updatePartner()
    {
        $validated = $this->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:partners,email,{$this->partnerId}",
            'phone' => 'nullable|string|max:20',
            'description' => 'nullable|string',
            'status' => 'required|string|in:сотрудничаем, прекратили сотрудничество',
        ]);

        $partner = Partner::withTrashed()->findOrFail($this->partnerId);
        $partner->update($validated);

        $this->resetFields();
        session()->flash('message', 'Партнер успешно обновлен.');
    }

    public function deletePartner($id)
    {
        Partner::findOrFail($id)->delete();
        session()->flash('message', 'Партнер был помечен как удалённый.');
    }

    public function restorePartner($id)
    {
        Partner::withTrashed()->findOrFail($id)->restore();
        session()->flash('message', 'Партнер успешно восстановлен.');
    }

    public function forceDeletePartner($id)
    {
        Partner::withTrashed()->findOrFail($id)->forceDelete();
        session()->flash('message', 'Партнер полностью удалён.');
    }

    private function resetFields()
    {
        $this->name = '';
        $this->email = '';
        $this->phone = '';
        $this->description = '';
        $this->status = '';
        $this->partnerId = null;
        $this->isEditing = false;
    }
}
