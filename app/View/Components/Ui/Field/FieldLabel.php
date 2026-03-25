<?php

namespace App\View\Components\Ui\Field;

use App\View\Components\BaseUiComponent;

class FieldLabel extends BaseUiComponent
{
    private const BASE_CLASSES = 'has-data-checked:bg-primary/5 has-data-checked:border-primary/30 dark:has-data-checked:border-primary/20 dark:has-data-checked:bg-primary/10 gap-2 group-data-[disabled=true]/field:opacity-50 has-[>[data-slot=field]]:rounded-lg has-[>[data-slot=field]]:border *:data-[slot=field]:p-2.5 group/field-label peer/field-label flex w-fit leading-snug has-[>[data-slot=field]]:w-full has-[>[data-slot=field]]:flex-col';

    public function __construct(protected string $class = '')
    {
        parent::__construct(
            viewPath: 'components.ui.field.field-label',
            baseClasses: self::BASE_CLASSES,
            class: $class
        );
    }
}
