<?php

namespace App\View\Components\Ui;

use App\View\Components\BaseUiComponent;

class Divider extends BaseUiComponent
{
    public function __construct(protected string $class = '')
    {
        parent::__construct(
            viewPath: 'components.ui.divider',
            baseClasses: 'h-px bg-muted',
            class: $class
        );
    }
}
