<?php

namespace App\View\Components\Ui;

use App\Utils\ShadCn;

class Button extends ShadCn
{
    public function __construct(
        public string $variant = 'default',
        public string $size = 'default',
        public string $intent = 'primary', // new: intent (primary, info, success, warning, danger)
        public string $type = 'button',
        public string $class = '',
    ) {
        parent::__construct(
            view_path: "components.ui.button",
            base_classes: $this->buttonClasses(),
            class: $class
        );
    }

    private function buttonClasses(): array
    {
        $base = 'inline-flex items-center justify-center flex-shrink-0 rounded-full font-medium transition-all outline-none 
             disabled:opacity-50 disabled:pointer-events-none gap-2 h-[50px] px-6 py-2.5 transition-colors duration-300';

        $variants = [
            'default' => [
                'primary' => 'bg-primary text-primary-foreground hover:bg-primary/78',
                'success' => 'bg-success text-success-foreground hover:bg-success/78',
                'warning' => 'bg-warning text-warning-foreground hover:bg-warning/78',
                'danger' => 'bg-destructive text-destructive-foreground hover:bg-destructive/78',
                'info' => 'bg-info text-info-foreground hover:bg-info/78',
                'secondary' => 'bg-secondary text-secondary-foreground hover:bg-secondary/78',
                'muted' => 'bg-muted text-muted-foreground hover:bg-muted/78',
            ],
            'outline' => [
                'primary' => 'border border-primary text-primary bg-transparent hover:bg-muted',
                'success' => 'border border-success text-success bg-transparent hover:bg-muted',
                'warning' => 'border border-warning text-warning bg-transparent hover:bg-muted',
                'danger' => 'border border-danger text-destructive bg-transparent hover:bg-muted',
                'info' => 'border border-info text-info bg-transparent hover:bg-muted',
                'secondary' => 'border border-secondary text-secondary bg-transparent hover:bg-muted',
                'muted' => 'border border-muted text-muted bg-transparent hover:bg-muted',
            ],
            'ghost' => [
                'primary' => 'bg-transparent text-primary hover:bg-muted',
                'success' => 'bg-transparent text-success hover:bg-muted',
                'warning' => 'bg-transparent text-warning hover:bg-muted',
                'danger' => 'bg-transparent text-destructive hover:bg-muted',
                'info' => 'bg-transparent text-info hover:bg-muted',
                'secondary' => 'bg-transparent text-secondary hover:bg-muted',
                'muted' => 'bg-transparent text-muted-foreground hover:bg-muted',
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
            'icon' => 'h-[50px] w-[50px] justify-center !px-0 !py-0 text-xl',
        ];

        return [
            $base,
            $variants[$this->variant][$this->intent],
            $sizes[$this->size],
            $this->class
        ];
    }
}
