<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use PhpParser\Node\Expr\Cast\Double;

class Form extends Component
{
    /**
     * Create a new component instance.
     */
    public string $name;
    public string $cpf; 
    public string $phone;
    public string $birthdate;
    public float $amount;
    

    public function __construct($name, $cpf, $phone, $birthdate, $amount)
    {
        $this->name = $name;
        $this->cpf = $cpf;
        $this->phone = $phone;
        $this->birthdate = $birthdate;
        $this->amount = $amount;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form');
    }
}
