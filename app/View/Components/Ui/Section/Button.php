<?php

namespace App\View\Components\Ui\Section;

use App\Enums\Components\Button\Intent;
use App\Enums\Components\Button\Size;
use App\Enums\Components\Button\Variant;
use App\View\Components\Ui\Button as BaseButton;

class Button extends BaseButton
{
    public function __construct(
        ?Variant $variant = null,
        ?Size $size = null,
        ?Intent $intent = null,
        string $type = 'button',
        string $class = '',
    ) {
        parent::__construct(
            variant: $variant ?? Variant::Ghost,
            size: $size ?? Size::Default,
            intent: $intent ?? Intent::Primary,
            type: $type,
            class: twMerge('font-bold px-0 py-0 h-auto text-sm', $class),
        );
    }
}
