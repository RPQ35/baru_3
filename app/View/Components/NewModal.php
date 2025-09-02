<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\View\Component;

class NewModal extends Component
{

    public $title;
    public $potition;
    public $IdPointer;
    public $a;

    protected $AlowedPotition=['center','top'];

    /**
     * Create a new component instance.
     */
    public function __construct($potition='top',$title="modal")
    {
        //

        if (!in_array($potition, $this->AlowedPotition)) {
            throw ValidationException::withMessages([
                "potition" => "potition on NewModal must be one of :" . "\n". implode(', ', $this->AlowedPotition)
            ]);
        }
        $potition=="center"?$potition='modal-dialog-centered':'';
        $IdPointer=Hash::make('MyModal');

        $this->IdPointer=$IdPointer;
        $this->potition=$potition;
        $this->title=$title;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.NewModal');
    }
}
