<x-root>

    <div class="max-w-xl mx-auto space-y-6">
        {{-- Users --}}
        <div class="p-10 border rounded-xl my-10 ">
            <h1>Result from user Table </h1>
            @foreach ($users as $user)
                <div class="border-b py-4">
                    <br>
                    <div>
                        <b>Name :</b>
                        <span>{{ $user->profile->first_name }} {{ $user->profile->last_name }}</span>
                    </div>
                    <br>
                    <div>
                        <b>Role :</b>
                        <span>{{ $user->role->name->label() }}</span>
                    </div>
                    <div>
                        <b>Number of products :</b>
                        <span>{{ $user->productsCount() }}</span>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Brands --}}
        <div class="p-10 border rounded-xl my-10 ">
            <h1>Result from brands Table </h1>
            @foreach ($brands as $brand)
                <div class="border-b py-4">
                    <br>
                    <div>
                        <b>Name :</b>
                        <span>{{ $brand->name }}</span>
                    </div>
                    <br>
                    <div>
                        <b>Products :</b>
                        <div class="flex flex-row gap-4 overflow-x-auto">
                            @foreach ($brand->products as $product)
                                <div class="border rounded p-2 mb-2 shrink-0">
                                    <b>{{ $product->name }}</b>
                                    <p class="text-xs">{{ $product->images->count() }} images</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Categories --}}
        <div class="p-10 border rounded-xl my-10 ">
            <h1>Result from categories Table </h1>
            @foreach ($categories as $category)
                <div class="border-b py-4">
                    <br>
                    <div>
                        <b>Name :</b>
                        <span>{{ $category->name }}</span>
                    </div>
                    <br>
                    <div>
                        <b>Number of products :</b>
                        <span>{{ $category->products->count() }}</span>
                    </div>
                </div>
            @endforeach
        </div>
</x-root>