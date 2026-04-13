<?php

namespace App\View\Components\Ui\Card;

use App\View\Components\BaseUiComponent;

class CardDescription extends BaseUiComponent
{
    private const BASE_CLASSES = 'text-muted-foreground text-sm';

    public function __construct(protected string $class = '')
    {
        parent::__construct(
            viewPath: 'components.ui.card.card-description',
            baseClasses: self::BASE_CLASSES,
            class: $class
        );
    }
}
