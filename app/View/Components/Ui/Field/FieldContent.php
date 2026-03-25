<?php

namespace App\View\Components\Ui\Field;

use App\View\Components\BaseUiComponent;

class FieldContent extends BaseUiComponent
{
    private const BASE_CLASSES = 'gap-0.5 group/field-content flex flex-1 flex-col leading-snug';

    public function __construct(protected string $class = '')
    {
        parent::__construct(
            viewPath: 'components.ui.field.field-content',
            baseClasses: self::BASE_CLASSES,
            class: $class
        );
    }
}
