<?php

namespace App\View\Components\Ui;

use App\Utils\ShadCn;

class Input extends ShadCn
{
    public const BASE_CLASSES = "border-transparent focus-visible:border-primary focus-visible:bg-transparent aria-invalid:border-destructive dark:aria-invalid:border-destructive/50 h-12.5 rounded-xl border-2 bg-input px-3 py-1 text-base transition-colors file:h-6 file:text-sm file:font-medium md:text-sm file:text-foreground placeholder:text-muted-foreground w-full min-w-0 outline-none file:inline-flex file:border-0 file:bg-transparent disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50 selection:bg-primary/20";

    /**
     * Create a new component instance.
     */
    public function __construct(public string $class = '')
    {
        parent::__construct(view_path: "components.ui.input", base_classes: self::BASE_CLASSES, class: $class);
    }
}