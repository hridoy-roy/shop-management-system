<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;
use Illuminate\Http\Request;

class Select extends Component
{
    public string $label;
    public string $name;
    public mixed $value;
    public string $required;
    public string $targetColumn;
    public mixed $options;
    public string $inputId;
    //    public $inputClass;

    /**
     * Create a new component instance.
     *
     * @return void
     */

    public function __construct($label, $name, $options,$inputId='', $required = true, $targetColumn = 'name', $value = '')
    {
        $this->label = $label;
        $this->name = $name;
        $this->options = $options;
        $this->value = old($name, $value);
        $this->required = $required;
        $this->targetColumn = $targetColumn;
        $this->inputId = $inputId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render(): \Illuminate\Contracts\View\View|string|\Closure
    {
        return view('components.forms.select');
    }
}
