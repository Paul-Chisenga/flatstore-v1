<?php

namespace App\View\Components\Ui\Empty;

use App\View\Components\BaseUiComponent;

class EmptyHeader extends BaseUiComponent
{
    private const BASE_CLASSES = 'flex w-full max-w-md flex-col items-center gap-2';

    public function __construct(protected string $class = '')
    {
        parent::__construct(
            viewPath: 'components.ui.empty.empty-header',
            baseClasses: self::BASE_CLASSES,
            class: $class
        );
    }
}
