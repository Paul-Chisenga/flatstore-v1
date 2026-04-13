<?php

namespace App\View\Components\Ui;

use App\View\Components\BaseUiComponent;

class Checkbox extends BaseUiComponent
{
    public const BASE_CLASSES = 'accent-primary size-4 shrink-0 cursor-pointer rounded border-2 border-input transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary/50 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 aria-invalid:border-destructive';

    public function __construct(protected string $class = '')
    {
        parent::__construct(
            viewPath: 'components.ui.checkbox',
            baseClasses: self::BASE_CLASSES,
            class: $class
        );
    }
}
