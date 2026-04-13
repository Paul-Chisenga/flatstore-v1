<?php

namespace App\View\Components\Ui\Card;

use App\View\Components\BaseUiComponent;

class CardTitle extends BaseUiComponent
{
    private const BASE_CLASSES = 'leading-none font-semibold';

    public function __construct(protected string $class = '')
    {
        parent::__construct(
            viewPath: 'components.ui.card.card-title',
            baseClasses: self::BASE_CLASSES,
            class: $class
        );
    }
}
