<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class LabelComponent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $for, $text;
    public function __construct($for, $text)
    {
        $this->for = $for;
        $this->text = $text;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.label-component', [
            'for' => $this->for,
            'text' => $this->text,
        ]);
    }
}
