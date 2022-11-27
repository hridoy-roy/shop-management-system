<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Input extends Component
{

    public string $label;
    public string $type;
    public string $name;
    public string $placeholder;
    public mixed $value;
    public string $required;
    //    public $inputId;
    //    public $inputClass;


    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($placeholder = null, $label, $type, $name, $value = null, $required = true)
    {
        $this->label = $label;
        $this->type = $type;
        $this->name = $name;
        $this->placeholder = $placeholder;
        $this->value = old($name, $value);
        $this->required = $required;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.input');
    }
}
