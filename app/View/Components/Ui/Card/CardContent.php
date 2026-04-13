<?php

namespace App\View\Components\Ui\Card;

use App\View\Components\BaseUiComponent;

class CardContent extends BaseUiComponent
{
    private const BASE_CLASSES = 'px-6';

    public function __construct(protected string $class = '')
    {
        parent::__construct(
            viewPath: 'components.ui.card.card-content',
            baseClasses: self::BASE_CLASSES,
            class: $class
        );
    }
}
