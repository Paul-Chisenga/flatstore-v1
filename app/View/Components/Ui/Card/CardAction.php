<?php

namespace App\View\Components\Ui\Card;

use App\View\Components\BaseUiComponent;

class CardAction extends BaseUiComponent
{
    private const BASE_CLASSES = 'col-start-2 row-span-2 row-start-1 self-start justify-self-end';

    public function __construct(protected string $class = '')
    {
        parent::__construct(
            viewPath: 'components.ui.card.card-action',
            baseClasses: self::BASE_CLASSES,
            class: $class
        );
    }
}
