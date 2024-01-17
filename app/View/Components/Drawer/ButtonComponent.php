<?php

namespace App\View\Components\Drawer;

use Illuminate\View\Component;

class ButtonComponent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $id, $drawerId, $color, $iconClass, $text;
    public function __construct($id, $drawerId, $color, $iconClass, $text)
    {
        $this->id = $id;
        $this->drawerId = $drawerId;
        $this->color = $color;
        $this->iconClass = $iconClass;
        $this->text = $text;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.drawer.button-component', [
            'id' => $this->id,
            'drawerId' => $this->drawerId,
            'color' => $this->color,
            'iconClass' => $this->iconClass,
            'text' => $this->text,
        ]);
    }
}
