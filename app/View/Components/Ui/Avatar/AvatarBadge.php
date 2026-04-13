<?php

namespace App\View\Components\Ui\Avatar;

use App\View\Components\BaseUiComponent;

class AvatarBadge extends BaseUiComponent
{
    private const BASE_CLASSES = 'border-background absolute right-0 bottom-0 flex size-3 items-center justify-center rounded-full border-2';

    public function __construct(protected string $class = '')
    {
        parent::__construct(
            viewPath: 'components.ui.avatar.avatar-badge',
            baseClasses: self::BASE_CLASSES,
            class: $class
        );
    }
}
