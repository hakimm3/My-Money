<?php

namespace App\View\Components\Breadcrumb;

use Illuminate\View\Component;

class NonActiveComponent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    private $text;
    public function __construct($text)
    {
        $this->text = $text;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.breadcrumb.non-active-component', [
            'text' => $this->text
        ]);
    }
}
