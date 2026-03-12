<?php

namespace App\View\Components\Ui\IconBox;

use App\View\Components\BaseUiComponent;

class Index extends BaseUiComponent
{
    public function __construct(protected string $class = '')
    {
        parent::__construct(
            viewPath: 'components.ui.icon-box.index',
            baseClasses: 'gap-y-2 flex flex-col items-center',
            class: $class
        );
    }
}
