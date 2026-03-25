<?php

namespace App\View\Components\Ui\Field;

use App\View\Components\BaseUiComponent;

class FieldLegend extends BaseUiComponent
{
    private const BASE_CLASSES = 'mb-1.5 font-medium data-[variant=label]:text-sm data-[variant=legend]:text-base';

    public function __construct(
        protected string $variant = 'legend',
        protected string $class = ''
    ) {
        parent::__construct(
            viewPath: 'components.ui.field.field-legend',
            baseClasses: self::BASE_CLASSES,
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
