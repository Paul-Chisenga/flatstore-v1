<?php

namespace App\View\Components\Ui\Item;

use App\View\Components\BaseUiComponent;

class ItemMedia extends BaseUiComponent
{
    private const BASE_CLASSES = 'shrink-0';

    private const VARIANTS = [
        'default' => 'size-10 rounded-md',
        'icon' => 'text-muted-foreground inline-flex size-10 items-center justify-center rounded-md bg-muted',
        'image' => 'size-10 overflow-hidden rounded-md',
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
