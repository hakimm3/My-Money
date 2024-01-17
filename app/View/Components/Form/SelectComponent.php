<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class SelectComponent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $id, $name, $options, $placeholder, $additionalAttributes;
    public function __construct($id, $name, $options, $placeholder, $additionalAttributes = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->options = $options;
        $this->placeholder = $placeholder;
        $this->additionalAttributes = $additionalAttributes;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.select-component', [
            'id' => $this->id,
            'name' => $this->name,
            'options' => $this->options,
            'placeholder' => $this->placeholder,
            'additionalAttributes' => $this->additionalAttributes
        ]);
    }
}
