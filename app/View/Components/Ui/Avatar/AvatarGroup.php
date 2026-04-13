<?php

namespace App\View\Components\Ui\Avatar;

use App\View\Components\BaseUiComponent;

class AvatarGroup extends BaseUiComponent
{
    private const BASE_CLASSES = 'flex items-center -space-x-2';

    public function __construct(protected string $class = '')
    {
        parent::__construct(
            viewPath: 'components.ui.avatar.avatar-group',
            baseClasses: self::BASE_CLASSES,
            class: $class
        );
    }
}
