<?php

namespace App\View\Components\Drawer;

use Illuminate\View\Component;

class MainComponent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $id, $title;
    public function __construct($id, $title)
    {
        $this->id = $id;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.drawer.main-component', [
            'id' => $this->id,
            'title' => $this->title
        ]);
    }
}
