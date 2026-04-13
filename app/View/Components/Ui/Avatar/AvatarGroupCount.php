<?php

namespace App\View\Components\Ui\Avatar;

use App\View\Components\BaseUiComponent;

class AvatarGroupCount extends BaseUiComponent
{
    private const BASE_CLASSES = 'border-background bg-muted text-muted-foreground relative flex size-10 shrink-0 items-center justify-center overflow-hidden rounded-full border-2 text-sm font-medium';

    public function __construct(protected string $class = '')
    {
        parent::__construct(
            viewPath: 'components.ui.avatar.avatar-group-count',
            baseClasses: self::BASE_CLASSES,
            class: $class
        );
    }
}
