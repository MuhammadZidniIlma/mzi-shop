<?php

namespace App\View\Components;

use App\Models\OrderItem;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class NavbarHome extends Component
{
    /**
     * Create a new component instance.
     */
    public $countTrolly;

    public function __construct()
    {

        // Hitung jumlah item di trolly berdasarkan user yang sedang login dan status 'pending'
        $this->countTrolly = Auth::check()
            ? OrderItem::with('order', 'product')
                ->whereHas('order', function ($query) {
                    $query->where('user_id', Auth::id())->where('status', 'unpaid');
                })->count()
            : 0;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.home.navbar-home');
    }
}
