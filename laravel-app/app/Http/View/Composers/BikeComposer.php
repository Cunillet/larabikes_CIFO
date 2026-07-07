<?php
namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Models\Bike;

class BikeComposer {
    public function compose(View $view) {
        /**
         * this can be a string or an array like this:
         * $view->with([
         * 'totalBikes' => Bike::count(),
         * 'bikes' => Bike::all()
         * ]);
         */
        $view->with('totalBikes', Bike::count());
    }
}

