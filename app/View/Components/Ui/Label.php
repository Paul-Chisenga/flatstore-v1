<?php

namespace App\View\Components\Ui;

use App\View\Components\BaseUiComponent;

class Label extends BaseUiComponent
{
    protected const BASE_CLASSES = 'gap-2 text-sm leading-none font-medium group-data-[disabled=true]:opacity-50 peer-disabled:opacity-50 flex items-center select-none group-data-[disabled=true]:pointer-events-none peer-disabled:cursor-not-allowed';

    /**
     * Create a new component instance.
     */
    public function __construct(protected string $class = '')
    {
        parent::__construct(viewPath: 'components.ui.label', baseClasses: self::BASE_CLASSES, class: $class);
    }
}
