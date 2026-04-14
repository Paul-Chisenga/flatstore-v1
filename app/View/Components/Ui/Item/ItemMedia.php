<?php

namespace App\View\Components\Ui\Item;

use App\View\Components\BaseUiComponent;

class ItemMedia extends BaseUiComponent
{
    private const BASE_CLASSES = 'flex shrink-0 items-center justify-center gap-2 group-has-data-[slot=item-description]/item:translate-y-0.5 group-has-data-[slot=item-description]/item:self-start [&_svg]:pointer-events-none';

    private const VARIANTS = [
        'default' => 'bg-transparent',
        'icon' => "[&_svg:not([class*='size-'])]:size-4",
        'image' => 'size-10 overflow-hidden rounded-sm group-data-[size=sm]/item:size-8 group-data-[size=xs]/item:size-6 [&_img]:size-full',
        'avatar' => 'size-10 rounded-full overflow-hidden',
    ];

    public function __construct(
        protected string $variant = 'default',
        protected string $class = ''
    ) {
        parent::__construct(
            viewPath: 'components.ui.item.item-media',
            baseClasses: [self::BASE_CLASSES, self::VARIANTS[$variant] ?? self::VARIANTS['default']],
            class: $class
        );
    }

    /**
     * @return array<string, mixed>
     */
    protected function exposeToView(): array
    {
        return [
            'variant' => $this->variant,
        ];
    }
}
