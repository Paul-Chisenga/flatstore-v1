<?php

namespace App\View\Components\Ui\Card;

use App\View\Components\BaseUiComponent;

class CardHeader extends BaseUiComponent
{
    private const BASE_CLASSES = '@container/card-header grid auto-rows-min grid-rows-[auto_auto] items-start gap-1.5 px-6 has-data-[slot=card-action]:grid-cols-[1fr_auto] [.border-b]:pb-6';

    public function __construct(protected string $class = '')
    {
        parent::__construct(
            viewPath: 'components.ui.card.card-header',
            baseClasses: self::BASE_CLASSES,
            class: $class
        );
    }
}
