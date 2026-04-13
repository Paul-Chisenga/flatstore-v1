<?php

namespace App\View\Components\Ui\Item;

use App\View\Components\BaseUiComponent;

class ItemFooter extends BaseUiComponent
{
    private const BASE_CLASSES = 'text-muted-foreground mt-2 w-full text-sm';

    public function __construct(protected string $class = '')
    {
        parent::__construct(
            viewPath: 'components.ui.item.item-footer',
            baseClasses: self::BASE_CLASSES,
            class: $class
        );
    }
}
