<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BlogPost extends Component
{
    /**
     * Create a new component instance.
     */
    public $posts;

    public $viewAllPost;

    public $title;

    public function __construct($posts, $title, $viewAllPost = false)
    {
        $this->title = $title;
        $this->posts = $posts;
        $this->viewAllPost = $viewAllPost;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.home.blog-post');
    }
}
