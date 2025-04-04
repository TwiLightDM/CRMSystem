<?php

namespace App\Livewire;

use App\Models\Source;
use Livewire\Component;

class Sources extends Component
{
    public $type, $sourceId;
    public $isEditing = false;

    public function render()
    {
        return view('livewire.sources', [
            'sources' => Source::all(),
        ]);
    }

    public function createSource()
    {
        $validated = $this->validate([
            'type' => "required|string|max:255|unique:sources,type,{$this->sourceId}",
        ]);
        Source::create($validated);

        $this->resetFields();
        session()->flash('message', 'Источник успешно добавлен.');
    }

    public function editSource($id)
    {
        $source = Source::withTrashed()->findOrFail($id);
        $this->sourseId = $source->id;
        $this->type = $source->type;
        $this->isEditing = true;
    }

    public function updateSource()
    {
        $validated = $this->validate([
            'type' => 'required|string|max:255',
        ]);

        $source = Source::withTrashed()->findOrFail($this->sourceId);
        $source->update($validated);

        $this->resetFields();
        session()->flash('message', 'Источник успешно обновлен.');
    }

    public function deleteSource($id)
    {
        Source::findOrFail($id)->delete();
        session()->flash('message', 'Источник был помечен как удалённый.');
    }

    public function restoreSource($id)
    {
        Source::withTrashed()->findOrFail($id)->restore();
        session()->flash('message', 'Источник успешно восстановлен.');
    }

    public function forceDeleteSource($id)
    {
        Source::withTrashed()->findOrFail($id)->forceDelete();
        session()->flash('message', 'Источник полностью удалён.');
    }

    private function resetFields()
    {
        $this->type = '';
        $this->sourceId = null;
        $this->isEditing = false;
    }
}
