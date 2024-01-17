<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class ButtonComponent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $type, $text, $additionalAttributes;
    public function __construct($type, $text, $additionalAttributes = null)
    {
        $this->type = $type;
        $this->text = $text;
        $this->additionalAttributes = $additionalAttributes;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.button-component', [
            'type' => $this->type,
            'text' => $this->text,
            'additionalAttributes' => $this->additionalAttributes
        ]);
    }
}
