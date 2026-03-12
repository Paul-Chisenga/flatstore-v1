<?php

namespace App\View\Components\Ui\Section;

use App\View\Components\BaseUiComponent;

class Index extends BaseUiComponent
{
    public function __construct(protected string $class = '')
    {
        parent::__construct(
            viewPath: 'components.ui.section.index',
            baseClasses: 'px-4',
            class: $class
        );
    }
}
