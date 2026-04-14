<?php

namespace App\View\Components\Ui\Alert;

use App\View\Components\BaseUiComponent;

class Alert extends BaseUiComponent
{
    private const BASE_CLASSES = 'relative grid w-full grid-cols-[0_1fr] gap-x-3 rounded-lg border px-4 py-3 text-sm has-[>svg]:grid-cols-[2rem_1fr] [&>svg]:size-4 [&>svg]:translate-y-0.5 [&>svg]:text-current';

    private const VARIANT_CLASSES = [
        'default' => 'bg-background text-foreground',
        'destructive' => 'border-destructive/20 bg-destructive/10 text-destructive dark:bg-destructive/20 [&>svg]:text-destructive',
    ];

    public function __construct(
        protected string $variant = 'default',
        protected string $class = ''
    ) {
        parent::__construct(
            viewPath: 'components.ui.alert.alert',
            baseClasses: [self::BASE_CLASSES, self::VARIANT_CLASSES[$variant] ?? self::VARIANT_CLASSES['default']],
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
