<?php

namespace App\View\Components;

use Closure;
use App\Models\User as UserModel;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class User extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public ?UserModel $user)
    {
        if (is_null($user)) {
            $this->user = new UserModel();
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.user');
    }
}
