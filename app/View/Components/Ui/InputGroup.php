<?php

namespace App\View\Components\Ui;

use App\Utils\ShadCn;

class InputGroup extends ShadCn
{
    private const BASE_CLASSES = "h-12.5 rounded-xl bg-input px-3 py-1 border-transparent border-2 has-[[data-slot=input-group-control]:focus-visible]:border-primary has-[[data-slot=input-group-control]:focus-visible]:bg-transparent has-[[data-slot][aria-invalid=true]]:border-destructive/50 transition-colors in-data-[slot=combobox-content]:focus-within:border-inherit has-disabled:opacity-50  has-[>[data-align=block-end]]:h-auto has-[>[data-align=block-end]]:flex-col has-[>[data-align=block-start]]:h-auto has-[>[data-align=block-start]]:flex-col has-[>[data-align=block-end]]:[&>input]:pt-3 has-[>[data-align=block-start]]:[&>input]:pb-3 has-[>[data-align=inline-end]]:[&>input]:pr-3 has-[>[data-align=inline-start]]:[&>input]:pl-3 group/input-group relative flex w-full min-w-0 items-center outline-none has-[>textarea]:h-auto";

    /**
     * Extra classes passed in from Blade.
     */
    public function __construct(public string $class = '')
    {
        parent::__construct(view_path: "components.ui.input-group", base_classes: self::BASE_CLASSES, class: $class);
    }
}
