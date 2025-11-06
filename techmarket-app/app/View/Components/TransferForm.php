<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TransferForm extends Component
{
    /**
     * Create a new component instance.
     */

    public string $fromCpf;
    public string $toCpf;
    public float $amount;

    public function __construct($fromCpf, $toCpf, $amount)
    {
        $this->fromCpf = $fromCpf;
        $this->toCpf = $toCpf;
        $this->amount = $amount;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.transfer-form');
    }
}
