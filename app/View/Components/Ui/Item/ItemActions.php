<?php

namespace App\View\Components\Ui\Item;

use App\View\Components\BaseUiComponent;

class ItemActions extends BaseUiComponent
{
    private const BASE_CLASSES = 'ms-auto flex shrink-0 items-center gap-2';

    public function __construct(protected string $class = '')
    {
        parent::__construct(
            viewPath: 'components.ui.item.item-actions',
            baseClasses: self::BASE_CLASSES,
            class: $class
        );
    }
}
