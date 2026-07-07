<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Biketile extends Component
{
    public string $id;
    public string $brand;
    public string $model;
    public int $kms;
    public string $image;
    public float $price;
    /**
     * Create a new component instance.
     */
    public function __construct(string $id, string $brand, string $model, int $kms, string $image, float $price)
    {
        $this->id = $id;
        $this->brand = $brand;
        $this->model = $model;
        $this->kms = $kms;
        $this->price = $price;
        $this->image = !empty($image) ? $image : 'image/img-not-found.jpg';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.biketile');
    }
}
