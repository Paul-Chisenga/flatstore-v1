<?php

namespace App\View\Components\Ui\Empty;

use App\View\Components\BaseUiComponent;

class EmptyTitle extends BaseUiComponent
{
    private const BASE_CLASSES = 'text-lg font-semibold tracking-tight';

    public function __construct(protected string $class = '')
    {
        parent::__construct(
            viewPath: 'components.ui.empty.empty-title',
            baseClasses: self::BASE_CLASSES,
            class: $class
        );
    }
}
