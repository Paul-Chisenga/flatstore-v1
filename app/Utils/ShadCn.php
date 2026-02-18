<?php

namespace App\Utils;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use TailwindMerge\Laravel\Facades\TailwindMerge;

class ShadCn extends Component
{
    /**
     * Extra classes passed in from Blade.
     */
    public function __construct(private View|Closure|string $view_path, private array|string $base_classes, public string $class = '')
    {
        //
    }

    /**
     * Merge base classes with any user-provided classes.
     * @return string
     */
    public function classes(): string
    {
        return TailwindMerge::merge($this->base_classes, $this->class);
    }

    /**
     * Render the Blade view.
     */
    public function render(): View|Closure|string
    {
        return view($this->view_path);
    }
}
