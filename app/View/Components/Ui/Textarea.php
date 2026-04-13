<?php

namespace App\View\Components\Ui;

use App\View\Components\BaseUiComponent;

class Textarea extends BaseUiComponent
{
    public const BASE_CLASSES = 'border-transparent focus-visible:border-primary focus-visible:bg-transparent aria-invalid:border-destructive min-h-30 rounded-xl border-2 bg-input px-3 py-3 text-base transition-colors md:text-sm placeholder:text-muted-foreground w-full min-w-0 outline-none resize-y disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50 selection:bg-primary/20';

    public function __construct(protected string $class = '')
    {
        parent::__construct(
            viewPath: 'components.ui.textarea',
            baseClasses: self::BASE_CLASSES,
            class: $class
        );
    }
}
