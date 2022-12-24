<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class InputDate extends Component
{

    public string $label;
    public string $name;
    public mixed $value;
    public string $required;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label,$name,$value = null,$required = true)
    {
        $this->label = $label;
        $this->name = $name;
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
        return view('components.forms.input-date');
    }
}
