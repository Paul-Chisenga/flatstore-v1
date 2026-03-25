<?php

namespace App\View\Components\Ui\Field;

use App\View\Components\BaseUiComponent;

class FieldDescription extends BaseUiComponent
{
    private const BASE_CLASSES = 'text-muted-foreground text-left text-sm [[data-variant=legend]+&]:-mt-1.5 leading-normal font-normal group-has-data-horizontal/field:text-balance last:mt-0 nth-last-2:-mt-1 [&>a]:underline [&>a]:underline-offset-4 [&>a:hover]:text-primary';

    public function __construct(protected string $class = '')
    {
        parent::__construct(
            viewPath: 'components.ui.field.field-description',
            baseClasses: self::BASE_CLASSES,
            class: $class
        );
    }
}
