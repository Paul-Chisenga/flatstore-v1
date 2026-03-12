<?php

namespace App\View\Components\Ui\IconBox;

use App\View\Components\BaseUiComponent;

class Label extends BaseUiComponent
{
    public function __construct(protected string $class = '')
    {
        parent::__construct(
            viewPath: 'components.ui.icon-box.label',
            baseClasses: 'text-secondary-foreground text-xs font-medium',
            class: $class
        );
    }
}
