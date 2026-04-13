<?php

namespace App\View\Components\Ui\Empty;

use App\View\Components\BaseUiComponent;

class EmptyContent extends BaseUiComponent
{
    private const BASE_CLASSES = 'flex w-full max-w-md items-center justify-center gap-3';

    public function __construct(protected string $class = '')
    {
        parent::__construct(
            viewPath: 'components.ui.empty.empty-content',
            baseClasses: self::BASE_CLASSES,
            class: $class
        );
    }
}
