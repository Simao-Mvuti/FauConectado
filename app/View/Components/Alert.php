<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Alert extends Component
{
    public function __construct(
        public string $type,
        public ?string $message = null
    ) {}

    public function render(): View|Closure
    {
        return view('components.alert');
    }
}