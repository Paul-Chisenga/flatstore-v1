<?php

namespace App\View\Components\Ui;

use App\Utils\ShadCn;

class InputGroupAddon extends ShadCn
{
    private const BASE_CLASSES = "text-muted-foreground h-auto gap-2 py-1.5 text-lg font-medium group-data-[disabled=true]/input-group:opacity-50 [&>kbd]:rounded-[calc(var(--radius)-5px)] [&>svg:not([class*='size-'])]:size-4 flex cursor-text items-center justify-center select-none";
    private const ALIGN_VARIANTS = [
        'inline-start' => "has-[>button]:ml-[-0.3rem] has-[>kbd]:ml-[-0.15rem] order-first",
        'inline-end' => " has-[>button]:mr-[-0.3rem] has-[>kbd]:mr-[-0.15rem] order-last",
        'block-start' => "px-2.5 pt-2 group-has-[>input]/input-group:pt-2 [.border-b]:pb-2 order-first w-full justify-start",
        'block-end' => "px-2.5 pb-2 group-has-[>input]/input-group:pb-2 [.border-t]:pt-2 order-last w-full justify-start",
    ];
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $align = 'inline-start',
        public string $class = ''
    ) {
        parent::__construct(
            view_path: "components.ui.input-group-addon",
            base_classes: [self::BASE_CLASSES, self::ALIGN_VARIANTS[$this->align] ?? self::ALIGN_VARIANTS['inline-start']],
            class: $class
        );
    }
}
