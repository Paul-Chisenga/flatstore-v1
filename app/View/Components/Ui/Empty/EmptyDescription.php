<?php

namespace App\View\Components\Ui\Empty;

use App\View\Components\BaseUiComponent;

class EmptyDescription extends BaseUiComponent
{
    private const BASE_CLASSES = 'text-muted-foreground text-sm';

    public function __construct(protected string $class = '')
    {
        parent::__construct(
            viewPath: 'components.ui.empty.empty-description',
            baseClasses: self::BASE_CLASSES,
            class: $class
        );
    }
}
