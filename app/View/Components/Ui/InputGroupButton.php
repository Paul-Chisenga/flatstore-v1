<?php

namespace App\View\Components\Ui;

use App\Utils\ShadCn;
use TailwindMerge\Laravel\Facades\TailwindMerge;

class InputGroupButton extends ShadCn
{
    private const BASE_CLASSES = "gap-2 text-lg shadow-none flex items-center";
    private const SIZE_VARIANTS = [
        'xs' => "!h-6 gap-1 rounded-[calc(var(--radius)-3px)] !px-1.5 [&>svg:not([class*='size-'])]:size-3.5",
        'sm' => "",
        'icon-xs' => "size-6 rounded-[calc(var(--radius)-3px)] p-0 has-[>svg]:p-0",
        'icon-sm' => "size-8 p-0 has-[>svg]:p-0",
    ];

    public function __construct(
        // public string $variant = 'ghost',
        public string $size = 'xs',
        public string $class = ''
    ) {
        parent::__construct(
            view_path: "components.ui.input-group-button",
            base_classes: [self::BASE_CLASSES, self::SIZE_VARIANTS[$this->size] ?? self::SIZE_VARIANTS['xs']],
            class: $class
        );
    }
}
