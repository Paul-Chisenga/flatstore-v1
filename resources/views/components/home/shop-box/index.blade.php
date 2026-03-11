<a {{ $attributes->merge(['class' => 'active:opacity-75 transition-opacity duration-150']) }}>
    <div class="flex flex-col items-center gap-2 text-center">
        <div
            class="size-12 rounded-full border border-border bg-card p-2 flex items-center justify-center overflow-hidden">
            {{ $logo }}
        </div>

        <div class="flex flex-col items-center gap-1">
            <span class="text-secondary-foreground text-xs font-medium">
                {{ $name }}
            </span>

            @isset($tagline)
                <span
                    class="inline-flex items-center rounded-full bg-secondary px-2 py-0.5 text-[10px] font-semibold text-secondary-foreground">
                    {{ $tagline }}
                </span>
            @endisset
        </div>
    </div>
</a>
