<?php

namespace App\View\Components\Ui\Item;

use App\View\Components\BaseUiComponent;

class ItemDescription extends BaseUiComponent
{
    private const BASE_CLASSES = 'text-muted-foreground truncate text-sm';

    public function __construct(protected string $class = '')
    {
        parent::__construct(
            viewPath: 'components.ui.item.item-description',
            baseClasses: self::BASE_CLASSES,
            class: $class
        );
    }
}
