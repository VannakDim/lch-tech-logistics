<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            {{-- Categories Grid --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Categories</h3>
                    <a href="" class="inline-flex items-center px-3 py-2 bg-sky-600 text-white text-sm font-medium rounded-md hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-sky-500" style="background-color: cornflowerblue;">
                        + Add Category
                    </a>
                </div>

                @if(!empty($categories) && $categories->count())
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach($categories as $category)
                            {{-- {{ $category->category_name }} --}}
                            <a href="{{ route('categories.show', $category->id ?? $category) }}" class="block group bg-gray-50 dark:bg-gray-900 rounded-lg overflow-hidden shadow hover:shadow-lg transition">
                                <div class="w-full h-48 bg-gray-200 dark:bg-gray-700 ">
                                    <img
                                        src="{{ $category->photo ?? (isset($category->photo) ? Storage::url($category->photo) : asset('storage/images/placeholder.jpg')) }}"
                                        alt="{{ $category->category_name ?? $category->category_name }}"
                                        style="height:150px;"
                                        class="object-cover group-hover:scale-105 transition-transform duration-150 py-2"
                                    >
                                </div>
                                <div class="p-4">
                                    <h4 class="text-sm font-semibold text-gray-900 dark:text-gray-100">{{ $category->category_name }}</h4>
                                    @if(isset($category->items_count))
                                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ $category->items_count }} items</p>
                                    @endif
                                </div>
                            </a>
                        @endforeach
                    </div>
                @else
                    <p class="text-sm text-gray-500 dark:text-gray-400">No categories found.</p>
                @endif
            </div>

            {{-- Items Grid --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Items</h3>
                    <a href="" class="inline-flex items-center px-3 py-2 bg-green-600 text-white text-sm font-medium rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500" style="background-color: cornflowerblue;">
                        + Add Item
                    </a>
                </div>

                @if(!empty($items) && $items->count())
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach($items as $item)
                            <a href="{{ route('items.show', $item->id ?? $item) }}" class="block group bg-gray-50 dark:bg-gray-900 rounded-lg overflow-hidden shadow hover:shadow-lg transition">
                                <div class="w-full h-48 bg-gray-200 dark:bg-gray-700">
                                    <img
                                        src="{{ $item->image_url ?? (isset($item->image) ? Storage::url($item->image) : asset('images/placeholder.png')) }}"
                                        alt="{{ $item->title ?? $item->name }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-150"
                                    >
                                </div>
                                <div class="p-4">
                                    <h4 class="text-sm font-semibold text-gray-900 dark:text-gray-100">{{ $item->title ?? $item->name }}</h4>
                                    @if(isset($item->price))
                                        <p class="text-sm text-gray-700 dark:text-gray-300">${{ number_format($item->price, 2) }}</p>
                                    @endif
                                    @if(isset($item->category_name))
                                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ $item->category_name }}</p>
                                    @endif
                                </div>
                            </a>
                        @endforeach
                    </div>

                    @if(method_exists($items, 'links'))
                        <div class="mt-6">
                            {{ $items->links() }}
                        </div>
                    @endif
                @else
                    <p class="text-sm text-gray-500 dark:text-gray-400">No items found.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
