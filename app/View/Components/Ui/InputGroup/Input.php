<?php

namespace App\View\Components\Ui\InputGroup;

use App\View\Components\BaseUiComponent;

class Input extends BaseUiComponent
{
    private const BASE_CLASSES = 'rounded-none outline-none border-0 bg-transparent shadow-none ring-0 focus-visible:ring-0 focus-visible:border-none disabled:bg-transparent dark:disabled:bg-transparent flex-1 selection:bg-primary/20';

    /**
     * Create a new component instance.
     */
    public function __construct(protected string $class = '')
    {
        parent::__construct(
            viewPath: 'components.ui.input-group.input',
            baseClasses: self::BASE_CLASSES,
            class: $class
        );
    }
}
