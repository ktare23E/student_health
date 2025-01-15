<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DynamicLink extends Component
{
    /**
     * Create a new component instance.
     */

    public $href;
    public $isActive;
    public $icon;
    public $text;

    public function __construct($href,$isActive,$icon,$text)
    {
        $this->href = $href;
        $this->isActive = $isActive;
        $this->icon = $icon;
        $this->text = $text;

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dynamic-link');
    }
}
