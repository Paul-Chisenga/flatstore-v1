<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use TailwindMerge\Laravel\Facades\TailwindMerge;

class BaseUiComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        private View|Closure|string $viewPath,
        private array|string $baseClasses,
        protected string $class = ''
    ) {
        //
    }

    /**
     * Merge base classes with any user-provided classes.
     */
    protected function mergeClasses(): string
    {
        return TailwindMerge::merge($this->baseClasses, $this->class);
    }

    /**
     * Per-component view data hook.
     *
     * @return array<string, mixed>
     */
    protected function exposeToView(): array
    {
        return [];
    }

    /**
     * Render the Blade view.
     */
    public function render(): View|Closure|string
    {
        return view($this->viewPath, [
            'class' => $this->mergeClasses(),
            ...$this->exposeToView(),
        ]);
    }
}
