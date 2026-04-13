<?php

namespace App\View\Components\Ui\Empty;

use App\View\Components\BaseUiComponent;

class EmptyMedia extends BaseUiComponent
{
    private const BASE_CLASSES = 'mb-2 flex items-center justify-center';

    private const VARIANTS = [
        'default' => 'size-14',
        'icon' => 'bg-muted text-muted-foreground size-14 rounded-full',
    ];

    public function __construct(
        protected string $variant = 'default',
        protected string $class = ''
    ) {
        parent::__construct(
            viewPath: 'components.ui.empty.empty-media',
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
