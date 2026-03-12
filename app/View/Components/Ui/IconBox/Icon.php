<?php

namespace App\View\Components\Ui\IconBox;

use App\View\Components\BaseUiComponent;

class Icon extends BaseUiComponent
{
    public function __construct(protected string $class = '')
    {
        parent::__construct(
            viewPath: 'components.ui.icon-box.icon',
            baseClasses: 'size-12 rounded-full flex flex-col justify-center items-center text-primary bg-secondary text-xl',
            class: $class
        );
    }
}
