<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class Input extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $type, $name, $id, $placeholder, $value, $additionalAttributes;
    public function __construct($type, $name, $id, $placeholder, $value = null, $additionalAttributes = null)
    {
        $this->type = $type;
        $this->name = $name;
        $this->id = $id;
        $this->placeholder = $placeholder;
        $this->value = $value;
        $this->additionalAttributes = $additionalAttributes;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.input', [
            'type' => $this->type,
            'name' => $this->name,
            'id' => $this->id,
            'placeholder' => $this->placeholder,
            'value' => $this->value,
            'additionalAttributes' => $this->additionalAttributes
        ]);
    }
}
