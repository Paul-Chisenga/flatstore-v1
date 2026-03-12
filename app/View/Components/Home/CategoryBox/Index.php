<?php

namespace App\View\Components\Home\CategoryBox;

use App\View\Components\BaseUiComponent;

class Index extends BaseUiComponent
{
    public function __construct(
        protected mixed $icon,
        protected mixed $label,
        protected string $class = ''
    ) {
        parent::__construct(
            viewPath: 'components.home.category-box.index',
            baseClasses: 'active:opacity-75 transition-opacity duration-150',
            class: $class
        );
    }

    /**
     * @return array<string, mixed>
     */
    protected function exposeToView(): array
    {
        return [
            'icon' => $this->icon,
            'label' => $this->label,
        ];
    }
}
