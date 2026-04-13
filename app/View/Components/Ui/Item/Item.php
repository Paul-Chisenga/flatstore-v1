<?php

namespace App\View\Components\Ui\Item;

use App\View\Components\BaseUiComponent;

class Item extends BaseUiComponent
{
    private const BASE_CLASSES = 'group/item flex w-full flex-wrap items-center rounded-lg border text-sm transition-colors duration-100 outline-none focus-visible:border-ring focus-visible:ring-[3px] focus-visible:ring-ring/50 [a]:transition-colors [a]:hover:bg-muted';

    private const VARIANTS = [
        'default' => 'border-transparent',
        'outline' => 'border bg-transparent',
        'muted' => 'bg-muted/40',
    ];

    private const SIZES = [
        'default' => 'min-h-16 px-4 py-3',
        'sm' => 'min-h-14 px-3 py-2',
        'xs' => 'min-h-12 px-2.5 py-2',
    ];

    public function __construct(
        protected string $variant = 'default',
        protected string $size = 'default',
        protected string $class = ''
    ) {
        parent::__construct(
            viewPath: 'components.ui.item.item',
            baseClasses: [
                self::BASE_CLASSES,
                self::VARIANTS[$variant] ?? self::VARIANTS['default'],
                self::SIZES[$size] ?? self::SIZES['default'],
            ],
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
            'size' => $this->size,
        ];
    }
}
