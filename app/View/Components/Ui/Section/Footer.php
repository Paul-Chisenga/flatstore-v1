<?php

namespace App\View\Components\Ui\Section;

use App\View\Components\BaseUiComponent;

class Footer extends BaseUiComponent
{
    public function __construct(protected string $class = '')
    {
        parent::__construct(
            viewPath: 'components.ui.section.footer',
            baseClasses: '',
            class: $class
        );
    }
}
