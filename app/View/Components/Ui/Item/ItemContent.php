<?php

namespace App\View\Components\Ui\Item;

use App\View\Components\BaseUiComponent;

class ItemContent extends BaseUiComponent
{
    private const BASE_CLASSES = 'min-w-0 flex-1';

    public function __construct(protected string $class = '')
    {
        parent::__construct(
            viewPath: 'components.ui.item.item-content',
            baseClasses: self::BASE_CLASSES,
            class: $class
        );
    }
}
