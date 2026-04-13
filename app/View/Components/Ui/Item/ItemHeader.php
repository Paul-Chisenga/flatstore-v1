<?php

namespace App\View\Components\Ui\Item;

use App\View\Components\BaseUiComponent;

class ItemHeader extends BaseUiComponent
{
    private const BASE_CLASSES = 'mb-2 w-full';

    public function __construct(protected string $class = '')
    {
        parent::__construct(
            viewPath: 'components.ui.item.item-header',
            baseClasses: self::BASE_CLASSES,
            class: $class
        );
    }
}
