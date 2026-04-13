<?php

namespace App\View\Components\Ui\Avatar;

use App\View\Components\BaseUiComponent;

class AvatarImage extends BaseUiComponent
{
    private const BASE_CLASSES = 'aspect-square size-full object-cover';

    public function __construct(protected string $class = '')
    {
        parent::__construct(
            viewPath: 'components.ui.avatar.avatar-image',
            baseClasses: self::BASE_CLASSES,
            class: $class
        );
    }
}
