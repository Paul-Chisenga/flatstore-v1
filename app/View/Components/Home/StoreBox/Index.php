<?php

namespace App\View\Components\Home\StoreBox;

use App\View\Components\BaseUiComponent;

class Index extends BaseUiComponent
{
    public function __construct(
        protected mixed $logo,
        protected string $name,
        protected ?string $tagline = null,
        protected string $class = ''
    ) {
        parent::__construct(
            viewPath: 'components.home.store-box.index',
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
            'logo' => $this->logo,
            'name' => $this->name,
            'tagline' => $this->tagline,
        ];
    }
}
