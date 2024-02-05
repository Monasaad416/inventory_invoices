<?php

namespace App\Livewire\Roles;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class DisplayRoles extends Component
{
    use WithPagination;
    public $listeners = ['refreshData' =>'$refresh'];
    public $searchItem;

    public $name,$permission;


    public function updatingSearchItem()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.roles.display-roles', ['roles' =>
            Role::select('id',
            'name')
            ->where('name','like','%'.$this->searchItem.'%')
            ->latest()->paginate(config('constants.paginationNo'))
        ]);
    }
}
