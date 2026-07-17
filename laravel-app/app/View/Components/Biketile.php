<?php

namespace App\View\Components;

use App\Models\Bike;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Biketile extends Component
{
    public Bike $bike;
    /**
     * Create a new component instance.
     */
    public function __construct(Bike $bike)
    {
        if (empty($bike->image)) {
            $bike['image'] = 'image/img-not-found.jpg';
        }
        $this->bike = $bike;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.biketile');
    }
}
