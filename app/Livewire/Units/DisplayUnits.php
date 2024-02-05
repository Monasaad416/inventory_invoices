<?php

namespace App\Livewire\Units;

use App\Models\Unit;
use Livewire\Component;
use Livewire\WithPagination;

class DisplayUnits extends Component
{
    use WithPagination;
    public $listeners = ['refreshData' =>'$refresh'];

    public $searchItem;

    public function updatingSearchItem()
    {
        $this->resetPage();
    }
    public function render()
    {
        return view('livewire.units.display-units', ['units' =>
            Unit::select('id',
            'name')
            ->where('name','like','%'.$this->searchItem.'%')
            ->latest()->paginate(config('constants.paginationNo'))
        ]);
    }
}
