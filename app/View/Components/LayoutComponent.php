<?php

namespace App\View\Components;

use Illuminate\View\Component;

class LayoutComponent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    private $pageHeader, $title;
    public function __construct($pageHeader, $title)
    {
        $this->pageHeader = $pageHeader;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.layout-component', [
            'pageHeader' => $this->pageHeader,
            'title' => $this->title
        ]);
    }
}
