<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class DisplayUsers extends Component
{
    use WithPagination;
    public $searchItem;
    public $listeners = ['refreshData' =>'$refresh'];

    public $name,$email,$roles_name,$user;


    public function updatingSearchItem()
    {
        $this->resetPage();
    }

    public function render()
    {

        return view('livewire.users.display-users',['users' => User::select('id',
            'name','email','roles_name')
            ->where('name','like','%'.$this->searchItem.'%')
            ->orWhere('email','like','%'.$this->searchItem.'%')
            ->orWhere('roles_name','like','%'.$this->searchItem.'%')
            ->latest()->paginate(config('constants.paginationNo'))
        ]);
    }
}
