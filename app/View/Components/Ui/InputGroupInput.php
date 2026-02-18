<?php

namespace App\View\Components\Ui;

use App\Utils\ShadCn;

class InputGroupInput extends ShadCn
{
    private const BASE_CLASSES = "rounded-none outline-none border-0 bg-transparent shadow-none ring-0 focus-visible:ring-0 focus-visible:border-none disabled:bg-transparent dark:disabled:bg-transparent flex-1 selection:bg-primary/20";
    /**
     * Create a new component instance.
     */
    public function __construct(public string $class = "")
    {
        parent::__construct(view_path: "components.ui.input-group-input", base_classes: self::BASE_CLASSES, class: $class);
    }
}
