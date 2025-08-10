<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class cards extends Component
{
    public $marginT;
    public $src;
    /**
     * Create a new component instance.
     */
    public function __construct($src,$marginT ="d")
    {
        $this->src = $src;
        $this->marginT = $marginT;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.cards');
    }
}
