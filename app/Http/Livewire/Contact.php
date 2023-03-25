<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Contact extends Component
{
    public $name;
    public $email;

    protected $rules = [
        'name' => 'required|min:6',
        'email' => 'required|email',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }




    // public $name;
    // public $email;

    

    // public function updated($propertyName)
    // {
    //      $this->validateOnly($propertyName, [
    //         'email' => 'required|email',
            
    //     ]);
    // }


    

    public function saveContact()
    {
        $validatedData = $this->validate();

        Contact::create($validatedData);
    }
}
