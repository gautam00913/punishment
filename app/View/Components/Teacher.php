<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Teacher extends Component
{
    public $classes;
    public $teacher;
  
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->teacher = auth()->user()->userable;
        $this->classes = $this->teacher->classes;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('teachers.home');
    }
}
