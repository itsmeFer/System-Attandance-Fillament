<?php

namespace App\Http\Livewire;

use Livewire\Component;

class FormComponent extends Component
{
    public $name;
    public $email;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
    ];

    public function submit()
    {
        $this->validate();

        // Handle form submission (e.g., save to database)

        session()->flash('message', 'Form submitted successfully!');
    }

    public function render()
    {
        return view('livewire.form-component');
    }
}
