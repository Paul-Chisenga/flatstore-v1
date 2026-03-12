<?php

namespace App\View\Components\Ui;

use App\Enums\Components\Button\Intent;
use App\Enums\Components\Button\Size;
use App\Enums\Components\Button\Variant;
use App\View\Components\BaseUiComponent;

class Button extends BaseUiComponent
{
    public function __construct(
        protected Variant $variant = Variant::Default,
        protected Size $size = Size::Default,
        protected Intent $intent = Intent::Primary,
        protected string $type = 'button',
        protected string $class = '',
    ) {
        parent::__construct(
            viewPath: 'components.ui.button',
            baseClasses: $this->buttonClasses($variant, $size, $intent),
            class: $class
        );
    }

    private function buttonClasses(Variant $variant, Size $size, Intent $intent): array
    {
        $base = 'active:opacity-50 inline-flex items-center justify-center flex-shrink-0 rounded-full font-medium transition-all outline-none
             disabled:opacity-50 disabled:pointer-events-none gap-2 h-[50px] px-6 py-2.5 transition-colors duration-300';

        $variants = [
            'default' => [
                'primary' => 'bg-primary text-primary-foreground hover:bg-primary/78 active:bg-primary/78',
                'success' => 'bg-success text-success-foreground hover:bg-success/78 active:bg-success/78',
                'warning' => 'bg-warning text-warning-foreground hover:bg-warning/78 active:bg-warning/78',
                'danger' => 'bg-destructive text-destructive-foreground hover:bg-destructive/78 active:bg-destructive/78',
                'info' => 'bg-info text-info-foreground hover:bg-info/78 active:bg-info/78',
                'secondary' => 'bg-secondary text-secondary-foreground hover:bg-secondary/78 active:bg-secondary/78',
                'muted' => 'bg-muted text-muted-foreground hover:bg-muted/78 active:bg-muted/78',
            ],
            'outline' => [
                'primary' => 'border border-primary text-primary bg-transparent hover:bg-muted active:bg-muted',
                'success' => 'border border-success text-success bg-transparent hover:bg-muted active:bg-muted',
                'warning' => 'border border-warning text-warning bg-transparent hover:bg-muted active:bg-muted',
                'danger' => 'border border-destructive text-destructive bg-transparent hover:bg-muted active:bg-muted',
                'info' => 'border border-info text-info bg-transparent hover:bg-muted active:bg-muted',
                'secondary' => 'border border-secondary text-secondary bg-transparent hover:bg-muted active:bg-muted',
                'muted' => 'border border-muted text-muted bg-transparent hover:bg-muted active:bg-muted',
            ],
            'ghost' => [
                'primary' => 'bg-transparent text-primary hover:bg-muted active:bg-muted',
                'success' => 'bg-transparent text-success hover:bg-muted active:bg-muted',
                'warning' => 'bg-transparent text-warning hover:bg-muted active:bg-muted',
                'danger' => 'bg-transparent text-destructive hover:bg-muted active:bg-muted',
                'info' => 'bg-transparent text-info hover:bg-muted active:bg-muted',
                'secondary' => 'bg-transparent text-secondary hover:bg-muted active:bg-muted',
                'muted' => 'bg-transparent text-muted-foreground hover:bg-muted active:bg-muted',
            ],
            'link' => [
                'primary' => 'bg-transparent text-primary underline-offset-4 hover:underline px-0 py-0 h-auto',
                'success' => 'bg-transparent text-success underline-offset-4 hover:underline px-0 py-0 h-auto',
                'warning' => 'bg-transparent text-warning underline-offset-4 hover:underline px-0 py-0 h-auto',
                'danger' => 'bg-transparent text-destructive underline-offset-4 hover:underline px-0 py-0 h-auto',
                'info' => 'bg-transparent text-info underline-offset-4 hover:underline px-0 py-0 h-auto',
                'secondary' => 'bg-transparent text-secondary underline-offset-4 hover:underline px-0 py-0 h-auto',
                'muted' => 'bg-transparent text-muted underline-offset-4 hover:underline px-0 py-0 h-auto',
            ],
        ];

        $sizes = [
            'default' => '',
            'sm' => 'h-[38px] px-3 py-1.5 text-sm',
            'xs' => 'h-[30px] px-2 py-1 text-xs',
            'icon' => 'h-[50px] w-[50px] justify-center !px-0 !py-0 text-xl',
            'icon-sm' => 'h-[38px] w-[38px] justify-center !px-0 !py-0 text-base',
            'icon-xs' => 'h-[30px] w-[30px] justify-center !px-0 !py-0 text-sm',
        ];

        return [
            $base,
            $variants[$variant->value][$intent->value],
            $sizes[$size->value],
        ];
    }

    /**
     * @return array<string, mixed>
     */
    protected function exposeToView(): array
    {
        return [
            'variant' => $this->variant->value,
            'size' => $this->size->value,
            'intent' => $this->intent->value,
            'type' => $this->type,
        ];
    }
}
