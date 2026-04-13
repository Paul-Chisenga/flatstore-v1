<?php

namespace App\View\Components\Ui\Item;

use App\View\Components\BaseUiComponent;

class ItemTitle extends BaseUiComponent
{
    private const BASE_CLASSES = 'truncate text-sm font-medium';

    public function __construct(protected string $class = '')
    {
        parent::__construct(
            viewPath: 'components.ui.item.item-title',
            baseClasses: self::BASE_CLASSES,
            class: $class
        );
    }
}
