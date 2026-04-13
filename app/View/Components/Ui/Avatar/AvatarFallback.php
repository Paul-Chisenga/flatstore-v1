<?php

namespace App\View\Components\Ui\Avatar;

use App\View\Components\BaseUiComponent;

class AvatarFallback extends BaseUiComponent
{
    private const BASE_CLASSES = 'bg-muted text-muted-foreground flex size-full items-center justify-center rounded-full text-sm font-medium';

    public function __construct(protected string $class = '')
    {
        parent::__construct(
            viewPath: 'components.ui.avatar.avatar-fallback',
            baseClasses: self::BASE_CLASSES,
            class: $class
        );
    }
}
