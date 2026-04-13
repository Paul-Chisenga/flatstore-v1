<?php

namespace App\View\Components\Ui\RadioGroup;

use App\View\Components\BaseUiComponent;

class RadioGroupItem extends BaseUiComponent
{
    public const BASE_CLASSES = 'accent-primary size-4 shrink-0 cursor-pointer rounded-full border-2 border-input transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary/50 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 aria-invalid:border-destructive';

    public function __construct(protected string $class = '')
    {
        parent::__construct(
            viewPath: 'components.ui.radio-group.radio-group-item',
            baseClasses: self::BASE_CLASSES,
            class: $class
        );
    }
}
