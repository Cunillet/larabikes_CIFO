<?php

namespace App\View\Components;

use App\Models\Bike;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Biketile extends Component
{
    public Bike $bike;
    public bool $editable;
    /**
     * Create a new component instance.
     */
    public function __construct(Bike $bike, bool $editable)
    {
        if (empty($bike->image)) {
            $bike['image'] = 'image/img-not-found.jpg';
        }
        $this->bike = $bike;
        if (is_string($editable)) {
            $editable = filter_var($editable, FILTER_VALIDATE_BOOLEAN);
        }
        $this->editable = $editable;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.biketile');
    }
}
