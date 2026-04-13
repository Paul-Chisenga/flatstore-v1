<?php

namespace App\View\Components\Ui\RadioGroup;

use App\View\Components\BaseUiComponent;

class RadioGroup extends BaseUiComponent
{
    private const BASE_CLASSES = 'flex flex-col gap-3';

    public function __construct(protected string $class = '')
    {
        parent::__construct(
            viewPath: 'components.ui.radio-group.radio-group',
            baseClasses: self::BASE_CLASSES,
            class: $class
        );
    }
}
