<x-root>
    <div class="min-h-screen bg-accent">
        <x-headers.admin />
        <main class="mx-auto flex w-full max-w-screen-2xl flex-1 flex-col p-4 md:px-6 md:py-0 md: mb-8">
            {{ $slot }}
        </main>
    </div>
</x-root>
