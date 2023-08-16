<?php

namespace App\View\Components;

use Closure;
use App\Models\Student;
use App\Models\ClassRoom;
use App\Models\Matter;
use App\Models\Teacher;
use App\Models\Tutor;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Administration extends Component
{
    public $classes;
    public $students;
    public $teachers;
    public $matters;
    public $tutors;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->classes = ClassRoom::count('id');
        $this->students = Student::count('id');
        $this->teachers = Teacher::count('id');
        $this->matters = Matter::count('id');
        $this->tutors = Tutor::count('id');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('admin.index');
    }
}
