<?php

namespace App\View\Components\Ui\Alert;

use App\View\Components\BaseUiComponent;

class AlertDescription extends BaseUiComponent
{
    private const BASE_CLASSES = 'col-start-2 grid justify-items-start gap-1 text-sm [&_p]:leading-relaxed';

    public function __construct(protected string $class = '')
    {
        parent::__construct(
            viewPath: 'components.ui.alert.alert-description',
            baseClasses: self::BASE_CLASSES,
            class: $class
        );
    }
}
