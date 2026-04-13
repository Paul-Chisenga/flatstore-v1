<?php

namespace App\View\Components\Ui\Item;

use App\View\Components\BaseUiComponent;

class ItemSeparator extends BaseUiComponent
{
    private const BASE_CLASSES = 'bg-border h-px w-full';

    public function __construct(protected string $class = '')
    {
        parent::__construct(
            viewPath: 'components.ui.item.item-separator',
            baseClasses: self::BASE_CLASSES,
            class: $class
        );
    }
}
