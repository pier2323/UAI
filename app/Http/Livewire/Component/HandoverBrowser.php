<?php

namespace App\Http\Livewire\Component;

use App\Models\HandoverDocument;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class HandoverBrowser extends Component
{
    public Collection $handoverDocuments;

    public bool $open = false;


    public function mount(): void
    {
        $this->handoverDocuments = HandoverDocument::with('employeeOutgoing')->get();
    }

    public function render()
    {
        return view('livewire.component.handover-browser');
    }
}
