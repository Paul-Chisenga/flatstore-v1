<?php

namespace App\View\Components\Ui\Avatar;

use App\View\Components\BaseUiComponent;

class Avatar extends BaseUiComponent
{
    private const BASE_CLASSES = 'relative flex shrink-0 overflow-hidden rounded-full';

    private const SIZES = [
        'sm' => 'size-8',
        'default' => 'size-10',
        'lg' => 'size-14',
    ];

    public function __construct(
        protected string $size = 'default',
        protected string $class = ''
    ) {
        parent::__construct(
            viewPath: 'components.ui.avatar.avatar',
            baseClasses: [self::BASE_CLASSES, self::SIZES[$size] ?? self::SIZES['default']],
            class: $class
        );
    }

    /**
     * @return array<string, mixed>
     */
    protected function exposeToView(): array
    {
        return [
            'size' => $this->size,
        ];
    }
}
