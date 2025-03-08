<?php

namespace App\Livewire;

use App\Models\Lead;
use Livewire\Component;

class Leads extends Component
{
    public function render()
    {
        $leadsCount = Lead::query()->count();
        $leads = Lead::all();
        return view('livewire.leads', [
            'leadsCount' => $leadsCount,
            'leads' => $leads,
        ]);
    }
}
