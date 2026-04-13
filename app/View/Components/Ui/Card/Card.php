<?php

namespace App\View\Components\Ui\Card;

use App\View\Components\BaseUiComponent;

class Card extends BaseUiComponent
{
    private const BASE_CLASSES = 'bg-card text-card-foreground flex flex-col gap-6 rounded-xl border py-6 shadow-sm';

    private const SIZE_VARIANTS = [
        'default' => '',
        'sm' => 'gap-4 py-4',
    ];

    public function __construct(
        protected string $size = 'default',
        protected string $class = ''
    ) {
        parent::__construct(
            viewPath: 'components.ui.card.card',
            baseClasses: [self::BASE_CLASSES, self::SIZE_VARIANTS[$size] ?? self::SIZE_VARIANTS['default']],
            class: $class
        );
    }

    /**
     * @return array<string, mixed>
     */
    protected function exposeToView(): array
    {
        return [
            'size' => $this->size,
        ];
    }
}
