<?php

namespace App\View\Components\Ui\Field;

use App\View\Components\BaseUiComponent;

class FieldSeparator extends BaseUiComponent
{
    private const BASE_CLASSES = '-my-2 h-5 text-sm group-data-[variant=outline]/field-group:-mb-2 relative';

    public function __construct(protected string $class = '')
    {
        parent::__construct(
            viewPath: 'components.ui.field.field-separator',
            baseClasses: self::BASE_CLASSES,
            class: $class
        );
    }
}
