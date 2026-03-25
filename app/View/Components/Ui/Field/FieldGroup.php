<?php

namespace App\View\Components\Ui\Field;

use App\View\Components\BaseUiComponent;

class FieldGroup extends BaseUiComponent
{
    private const BASE_CLASSES = 'gap-5 data-[slot=checkbox-group]:gap-3 *:data-[slot=field-group]:gap-4 group/field-group @container/field-group flex w-full flex-col';

    public function __construct(protected string $class = '')
    {
        parent::__construct(
            viewPath: 'components.ui.field.field-group',
            baseClasses: self::BASE_CLASSES,
            class: $class
        );
    }
}
