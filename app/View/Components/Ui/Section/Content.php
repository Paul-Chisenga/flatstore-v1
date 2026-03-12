<?php

namespace App\View\Components\Ui\Section;

use App\View\Components\BaseUiComponent;

class Content extends BaseUiComponent
{
    public function __construct(protected string $class = '')
    {
        parent::__construct(
            viewPath: 'components.ui.section.content',
            baseClasses: '',
            class: $class
        );
    }
}
