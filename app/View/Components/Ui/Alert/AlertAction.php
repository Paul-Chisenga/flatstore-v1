<?php

namespace App\View\Components\Ui\Alert;

use App\View\Components\BaseUiComponent;

class AlertAction extends BaseUiComponent
{
    private const BASE_CLASSES = 'col-start-2';

    public function __construct(protected string $class = '')
    {
        parent::__construct(
            viewPath: 'components.ui.alert.alert-action',
            baseClasses: self::BASE_CLASSES,
            class: $class
        );
    }
}
