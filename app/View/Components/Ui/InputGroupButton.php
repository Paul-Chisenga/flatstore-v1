<?php

namespace App\View\Components\Ui;

use App\Enums\Components\Button\Intent;
use App\Enums\Components\Button\Size;
use App\Enums\Components\Button\Variant;
use App\View\Components\BaseUiComponent;

class InputGroupButton extends BaseUiComponent
{
    private const BASE_CLASSES = 'gap-2 text-lg shadow-none flex items-center';

    private const SIZE_VARIANTS = [
        'xs' => "!h-6 gap-1 rounded-[calc(var(--radius)-3px)] !px-1.5 [&>svg:not([class*='size-'])]:size-3.5",
        'sm' => '',
        'icon-xs' => 'size-6 rounded-[calc(var(--radius)-3px)] p-0 has-[>svg]:p-0',
        'icon-sm' => 'size-8 p-0 has-[>svg]:p-0',
    ];

    public function __construct(
        protected string $variant = 'ghost',
        protected string $size = 'xs',
        protected string $intent = 'muted',
        protected string $class = ''
    ) {
        parent::__construct(
            viewPath: 'components.ui.input-group-button',
            baseClasses: [self::BASE_CLASSES, self::SIZE_VARIANTS[$size] ?? self::SIZE_VARIANTS['xs']],
            class: $class
        );
    }

    /**
     * @return array<string, mixed>
     */
    protected function exposeToView(): array
    {
        return [
            'variant' => Variant::tryFrom($this->variant) ?? Variant::Ghost,
            'intent' => Intent::tryFrom($this->intent) ?? Intent::Muted,
            'size' => Size::tryFrom($this->size) ?? Size::Default,
        ];
    }
}
