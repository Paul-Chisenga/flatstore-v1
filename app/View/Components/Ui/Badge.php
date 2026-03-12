<?php

namespace App\View\Components\Ui;

use App\Enums\Components\Button\Intent;
use App\Enums\Components\Button\Variant;
use App\View\Components\BaseUiComponent;

class Badge extends BaseUiComponent
{
    public function __construct(
        protected Variant $variant = Variant::Default,
        protected Intent $intent = Intent::Primary,
        protected string $class = ''
    ) {
        parent::__construct(
            viewPath: 'components.ui.badge',
            baseClasses: $this->badgeClasses($variant, $intent),
            class: $class
        );
    }

    /**
     * @return array<int, string>
     */
    private function badgeClasses(Variant $variant, Intent $intent): array
    {
        $base = 'inline-flex h-6 items-center justify-center rounded px-3 text-sm font-medium transition-colors duration-300';

        $variants = [
            'default' => [
                'primary' => 'bg-primary text-primary-foreground',
                'success' => 'bg-success text-success-foreground',
                'warning' => 'bg-warning text-warning-foreground',
                'danger' => 'bg-destructive text-destructive-foreground',
                'info' => 'bg-info text-info-foreground',
                'secondary' => 'bg-secondary text-secondary-foreground',
                'muted' => 'bg-muted text-muted-foreground',
            ],
            'outline' => [
                'primary' => 'border border-primary text-primary bg-transparent',
                'success' => 'border border-success text-success bg-transparent',
                'warning' => 'border border-warning text-warning bg-transparent',
                'danger' => 'border border-destructive text-destructive bg-transparent',
                'info' => 'border border-info text-info bg-transparent',
                'secondary' => 'border border-secondary text-secondary bg-transparent',
                'muted' => 'border border-muted text-muted-foreground bg-transparent',
            ],
            'ghost' => [
                'primary' => 'bg-primary/10 text-primary',
                'success' => 'bg-success/10 text-success',
                'warning' => 'bg-warning/12 text-warning',
                'danger' => 'bg-destructive/10 text-destructive',
                'info' => 'bg-info/10 text-info',
                'secondary' => 'bg-secondary/50 text-secondary-foreground',
                'muted' => 'bg-muted text-muted-foreground',
            ],
            'link' => [
                'primary' => 'bg-transparent text-primary underline underline-offset-4 px-0',
                'success' => 'bg-transparent text-success underline underline-offset-4 px-0',
                'warning' => 'bg-transparent text-warning underline underline-offset-4 px-0',
                'danger' => 'bg-transparent text-destructive underline underline-offset-4 px-0',
                'info' => 'bg-transparent text-info underline underline-offset-4 px-0',
                'secondary' => 'bg-transparent text-secondary underline underline-offset-4 px-0',
                'muted' => 'bg-transparent text-muted-foreground underline underline-offset-4 px-0',
            ],
        ];

        return [
            $base,
            $variants[$variant->value][$intent->value],
        ];
    }

    /**
     * @return array<string, mixed>
     */
    protected function exposeToView(): array
    {
        return [
            'variant' => $this->variant->value,
            'intent' => $this->intent->value,
        ];
    }
}
