<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AppLayout extends Component
{
    /* TODO: Add check for guest probably */
    public function render(): View
    {
        return view('components.app-layout');
    }
}
