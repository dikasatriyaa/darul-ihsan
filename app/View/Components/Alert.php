<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Alert extends Component
{
    public function __construct(
        public string $type = 'info',    // success | warning | error | info
        public string $message = '',
    ) {}

    // Method yang tersedia di view
    public function colorClass(): string
    {
        return match ($this->type) {
            'success' => 'bg-green-100 border-green-400 text-green-700',
            'warning' => 'bg-yellow-100 border-yellow-400 text-yellow-700',
            'error'   => 'bg-red-100 border-red-400 text-red-700',
            default   => 'bg-blue-100 border-blue-400 text-blue-700',
        };
    }

    public function render(): View
    {
        return view('components.alert');
    }
}
