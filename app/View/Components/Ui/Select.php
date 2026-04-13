<?php

namespace App\View\Components\Ui;

use App\View\Components\BaseUiComponent;

class Select extends BaseUiComponent
{
    public const BASE_CLASSES = 'border-transparent focus-visible:border-primary focus-visible:bg-transparent aria-invalid:border-destructive h-12.5 rounded-xl border-2 bg-input px-3 py-1 text-base transition-colors md:text-sm w-full min-w-0 outline-none cursor-pointer disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50';

    public function __construct(protected string $class = '')
    {
        parent::__construct(
            viewPath: 'components.ui.select',
            baseClasses: self::BASE_CLASSES,
            class: $class
        );
    }
}
