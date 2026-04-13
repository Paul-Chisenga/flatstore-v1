<?php

namespace App\View\Components\Ui\Empty;

use App\View\Components\BaseUiComponent;

class EmptyState extends BaseUiComponent
{
    private const BASE_CLASSES = 'flex w-full flex-col items-center justify-center gap-6 rounded-xl p-8 text-center';

    public function __construct(protected string $class = '')
    {
        parent::__construct(
            viewPath: 'components.ui.empty.empty',
            baseClasses: self::BASE_CLASSES,
            class: $class
        );
    }
}
