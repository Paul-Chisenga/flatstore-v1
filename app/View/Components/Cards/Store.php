<?php

namespace App\View\Components\Cards;

use App\View\Components\BaseUiComponent;

class Store extends BaseUiComponent
{
    public function __construct(
        protected string $name,
        protected ?string $tagline = null,
        protected ?string $logoUrl = null,
        protected string $productsUrl = '#',
        protected string $detailsUrl = '#',
        protected string $class = ''
    ) {
        parent::__construct(
            viewPath: 'components.cards.store',
            baseClasses: 'grid grid-cols-[84px_1fr] items-center gap-4 rounded-2xl border border-border bg-card',
            class: $class
        );
    }

    /**
     * @return array<string, mixed>
     */
    protected function exposeToView(): array
    {
        return [
            'name' => $this->name,
            'tagline' => $this->tagline,
            'logoUrl' => $this->logoUrl,
            'productsUrl' => $this->productsUrl,
            'detailsUrl' => $this->detailsUrl,
        ];
    }
}
