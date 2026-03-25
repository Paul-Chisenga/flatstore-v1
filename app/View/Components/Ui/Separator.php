<?php

namespace App\View\Components\Ui;

use App\View\Components\BaseUiComponent;
use Illuminate\View\Component;

class Separator extends BaseUiComponent
{
    protected const BASE_CLASSES = 'shrink-0 bg-border data-horizontal:h-px data-horizontal:w-full data-vertical:w-px data-vertical:self-stretch';

    /**
     * Create a new component instance.
     */
    public function __construct(protected string $class = '')
    {
        parent::__construct(viewPath: 'components.ui.separator', baseClasses: 'my-4 h-px bg-muted', class: $class);
    }

}
