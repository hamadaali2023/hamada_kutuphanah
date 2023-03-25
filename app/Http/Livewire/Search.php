<?php

namespace App\Http\Livewire;

use Livewire\Component;


use App\Book;
class Search extends Component
{

	public $search = '';

    public function render()
    {
        return view('livewire.search', [
            'users' => Book::where('name', $this->search)->get(),
        ]);


    }

    
}
