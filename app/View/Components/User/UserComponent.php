<?php

namespace App\View\Components\User;

use App\Models\User;
use App\Models\UserPost\Post;
use Illuminate\View\Component;

class UserComponent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $post;
    public function __construct(Post $post)
    {
        $this->post=$post;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.user.user-component');
    }
}
