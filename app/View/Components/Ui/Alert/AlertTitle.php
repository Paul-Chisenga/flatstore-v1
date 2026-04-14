<?php

namespace App\View\Components\Ui\Alert;

use App\View\Components\BaseUiComponent;

class AlertTitle extends BaseUiComponent
{
    private const BASE_CLASSES = 'col-start-2 line-clamp-1 min-h-4 font-medium tracking-tight';

    public function __construct(protected string $class = '')
    {
        parent::__construct(
            viewPath: 'components.ui.alert.alert-title',
            baseClasses: self::BASE_CLASSES,
            class: $class
        );
    }
}
