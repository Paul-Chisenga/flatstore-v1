<?php

namespace App\View\Components\Ui\Item;

use App\View\Components\BaseUiComponent;

class ItemGroup extends BaseUiComponent
{
    private const BASE_CLASSES = 'group/item-group flex w-full flex-col gap-4 has-data-[size=sm]:gap-2.5 has-data-[size=xs]:gap-2';

    public function __construct(protected string $class = '')
    {
        parent::__construct(
            viewPath: 'components.ui.item.item-group',
            baseClasses: self::BASE_CLASSES,
            class: $class
        );
    }
}
