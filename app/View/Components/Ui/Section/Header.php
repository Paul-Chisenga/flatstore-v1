<?php

namespace App\View\Components\Ui\Section;

use App\View\Components\BaseUiComponent;

class Header extends BaseUiComponent
{
    public function __construct(protected string $class = '')
    {
        parent::__construct(
            viewPath: 'components.ui.section.header',
            baseClasses: 'py-4 flex gap-4 items-center justify-between',
            class: $class
        );
    }
}
