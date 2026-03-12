<?php

namespace App\View\Components\Ui\Section;

use App\View\Components\BaseUiComponent;

class Title extends BaseUiComponent
{
    public function __construct(protected string $class = '')
    {
        parent::__construct(
            viewPath: 'components.ui.section.title',
            baseClasses: 'text-lg font-bold',
            class: $class
        );
    }
}
