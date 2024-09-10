<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class HeroHome extends Component
{
    /**
     * Create a new component instance.
     */
    public $title;

    public $description;

    public $primaryButtonUrl;

    public $primaryButtonText;

    public $secondaryButtonUrl;

    public $secondaryButtonText;

    public $imageUrl;

    public function __construct(
        $title,
        $description,
        $imageUrl = null,
        $primaryButtonUrl = null,
        $primaryButtonText = null,
        $secondaryButtonUrl = null,
        $secondaryButtonText = null
    ) {
        $this->title = $title;
        $this->description = $description;
        $this->primaryButtonUrl = $primaryButtonUrl;
        $this->primaryButtonText = $primaryButtonText;
        $this->secondaryButtonUrl = $secondaryButtonUrl;
        $this->secondaryButtonText = $secondaryButtonText;
        $this->imageUrl = $imageUrl;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {

        return view('components.home.hero-home');
    }
}
