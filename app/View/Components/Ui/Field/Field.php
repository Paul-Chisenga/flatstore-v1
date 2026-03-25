<?php

namespace App\View\Components\Ui\Field;

use App\View\Components\BaseUiComponent;

class Field extends BaseUiComponent
{
    private const BASE_CLASSES = 'data-[invalid=true]:text-destructive gap-2 group/field flex w-full';

    private const ORIENTATION_VARIANTS = [
        'vertical' => 'flex-col *:w-full [&>.sr-only]:w-auto',
        'horizontal' => 'flex-row items-center has-[>[data-slot=field-content]]:items-start *:data-[slot=field-label]:flex-auto has-[>[data-slot=field-content]]:[&>[role=checkbox],[role=radio]]:mt-px',
        'responsive' => 'flex-col *:w-full @md/field-group:flex-row @md/field-group:items-center @md/field-group:*:w-auto @md/field-group:has-[>[data-slot=field-content]]:items-start @md/field-group:*:data-[slot=field-label]:flex-auto [&>.sr-only]:w-auto @md/field-group:has-[>[data-slot=field-content]]:[&>[role=checkbox],[role=radio]]:mt-px',
    ];

    public function __construct(
        protected string $orientation = 'vertical',
        protected string $class = ''
    ) {
        parent::__construct(
            viewPath: 'components.ui.field.field',
            baseClasses: [self::BASE_CLASSES, self::ORIENTATION_VARIANTS[$orientation] ?? self::ORIENTATION_VARIANTS['vertical']],
            class: $class
        );
    }

    /**
     * @return array<string, mixed>
     */
    protected function exposeToView(): array
    {
        return [
            'orientation' => $this->orientation,
        ];
    }
}
