<?php

namespace App\Livewire;

use App\Models\Lead;
use Livewire\Component;

class Leads extends Component
{
    public $name, $email, $phone, $description, $status, $nominated_person, $leadId;
    public $isEditing = false;

    public function render()
    {
        return view('livewire.leads', [
            'leads' => Lead::all(),
        ]);
    }

    public function createLead()
    {
        $validated = $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:leads,email',
            'phone' => 'nullable|string|max:20',
            'description' => 'nullable|string',
            'status' => 'required|string|in:не обработан,в работе,ликвидный,бракованный',
            'nominated_person' => 'nullable|string|max:255',
        ]);

        $validated['date_of_creation'] = now();

        Lead::create($validated);

        $this->resetFields();
        session()->flash('message', 'Лид успешно добавлен.');
    }

    public function editLead($id)
    {
        $lead = Lead::withTrashed()->findOrFail($id);
        $this->leadId = $lead->id;
        $this->name = $lead->name;
        $this->email = $lead->email;
        $this->phone = $lead->phone;
        $this->description = $lead->description;
        $this->status = $lead->status;
        $this->nominated_person = $lead->nominated_person;
        $this->isEditing = true;
    }

    public function updateLead()
    {
        $validated = $this->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:leads,email,{$this->leadId}",
            'phone' => 'nullable|string|max:20',
            'description' => 'nullable|string',
            'status' => 'required|string|in:не обработан,в работе,ликвидный,бракованный',
            'nominated_person' => 'nullable|string|max:255',
        ]);

        $lead = Lead::withTrashed()->findOrFail($this->leadId);
        $lead->update($validated);

        $this->resetFields();
        session()->flash('message', 'Лид успешно обновлен.');
    }

    public function deleteLead($id)
    {
        Lead::findOrFail($id)->delete();
        session()->flash('message', 'Лид был помечен как удалённый.');
    }

    public function restoreLead($id)
    {
        Lead::withTrashed()->findOrFail($id)->restore();
        session()->flash('message', 'Лид успешно восстановлен.');
    }

    public function forceDeleteLead($id)
    {
        Lead::withTrashed()->findOrFail($id)->forceDelete();
        session()->flash('message', 'Лид полностью удалён.');
    }

    private function resetFields()
    {
        $this->name = '';
        $this->email = '';
        $this->phone = '';
        $this->description = '';
        $this->status = '';
        $this->nominated_person = '';
        $this->leadId = null;
        $this->isEditing = false;
    }
}
