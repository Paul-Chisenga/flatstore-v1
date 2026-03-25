<x-root>
    <div class="h-screen bg-accent p-10">
        <div class="max-w-3xl mx-auto border rounded-xl p-10 bg-card">
            <h1 class="text-2xl font-bold">Protected Page - Logged In as {{ Auth::user()->name }}</h1>
            <p class="mt-4">This page is only accessible to authenticated users.</p>
            <form method="POST" action="{{ route('logout') }}" class="mt-4">
                @csrf
                <x-ui.button type="submit">
                    Log Out
                </x-ui.button>
            </form>
        </div>
    </div>
</x-root>
