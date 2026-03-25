<?php

namespace App\View\Components\Ui\Field;

use App\View\Components\BaseUiComponent;

class FieldTitle extends BaseUiComponent
{
    private const BASE_CLASSES = 'gap-2 text-sm font-medium group-data-[disabled=true]/field:opacity-50 flex w-fit items-center leading-snug';

    public function __construct(protected string $class = '')
    {
        parent::__construct(
            viewPath: 'components.ui.field.field-title',
            baseClasses: self::BASE_CLASSES,
            class: $class
        );
    }
}
