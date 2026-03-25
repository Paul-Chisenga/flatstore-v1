<?php

namespace App\View\Components\Ui\Field;

use App\View\Components\BaseUiComponent;

class FieldSet extends BaseUiComponent
{
    private const BASE_CLASSES = 'gap-4 has-[>[data-slot=checkbox-group]]:gap-3 has-[>[data-slot=radio-group]]:gap-3 flex flex-col';

    public function __construct(protected string $class = '')
    {
        parent::__construct(
            viewPath: 'components.ui.field.field-set',
            baseClasses: self::BASE_CLASSES,
            class: $class
        );
    }
}
