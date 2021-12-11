<?php

namespace App\View\Components;

use App\Models\Category;
use Illuminate\View\Component;

class sliderMenu extends Component
{   
    public $categories; 
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Category $categories)
    {
        $categories = Category::limit(10)->get();
       $this->categories = $categories;  
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.slider-menu');
    }
}
