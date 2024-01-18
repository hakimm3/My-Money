<?php

namespace App\View\Components\Navbar;

use Illuminate\View\Component;

class ItemComponent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $route, $text, $isActive;
    public function __construct($route, $text, $isActive)
    {
        $this->route = $route;
        $this->text = $text;
        $this->isActive = $isActive;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.navbar.item-component', [
            'route' => $this->route,
            'text' => $this->text,
            'isActive' => $this->isActive
        ]);
    }
}
