<?php

namespace App\View\Components\Home\CategoryBox;

use App\View\Components\BaseUiComponent;

class Row extends BaseUiComponent
{
    public function __construct(protected string $class = '')
    {
        parent::__construct(
            viewPath: 'components.home.category-box.row',
            baseClasses: 'flex justify-between gap-4',
            class: $class
        );
    }
}
