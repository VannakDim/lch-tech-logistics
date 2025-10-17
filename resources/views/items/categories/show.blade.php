<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit Category
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            @if (session('success'))
                <div class="mb-4 px-4 py-3 rounded-md text-sm bg-green-50 text-green-800 dark:bg-green-900/30 dark:text-green-300">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="mb-4 px-4 py-3 rounded-md text-sm bg-red-50 text-red-800 dark:bg-red-900/30 dark:text-red-300">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 p-4 rounded-md bg-red-50 text-red-800 dark:bg-red-900/30 dark:text-red-300">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700">
                    <div class="flex items-start justify-between">
                        <div>
                            @if (isset($category))
                                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Edit Category — #{{ $category->id }}</h3>
                            @else
                                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">No category selected</h3>
                            @endif
                            @if(isset($category))
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Make changes below and click Update.</p>
                            @endif
                        </div>
                        {{-- @if(isset($category))
                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                <div>Created: <span class="font-medium text-gray-700 dark:text-gray-200">{{ $category->created_at->diffForHumans() }}</span></div>
                                <div>Updated: <span class="font-medium text-gray-700 dark:text-gray-200">{{ $category->updated_at->diffForHumans() }}</span></div>
                            </div>
                        @endif --}}
                    </div>
                </div>

                <div class="px-6 py-6">
                    @if (isset($category))
                        <form action="{{ route('categories.update', $category->id) }}" method="POST" class="space-y-6">
                            @csrf
                            @method('PUT')

                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                                <div class="mt-1">
                                    <input id="name" name="category_name" type="text"
                                        class="block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('name') ring-1 ring-red-500 @enderror"
                                        value="{{ old('name', $category->category_name) }}" required>
                                </div>
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="photo" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Category Photo</label>
                                <div class="mt-2 flex items-center space-x-4">
                                    @if(isset($category) && $category->photo)
                                        <img src="{{ Storage::url($category->photo) }}" alt="Category photo" class="w-20 h-20 object-cover rounded-md border dark:border-gray-600">
                                    @endif
                                    <div class="flex-1">
                                        <input id="photo" name="photo" type="file" accept="image/*"
                                            class="block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('photo') ring-1 ring-red-500 @enderror">
                                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Upload a new photo to replace the current one (optional).</p>
                                        @error('photo')
                                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                var form = document.querySelector('form');
                                if (form && form.enctype !== 'multipart/form-data') {
                                    form.enctype = 'multipart/form-data';
                                }
                            });
                            </script>

                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                                <div class="mt-1">
                                    <textarea id="description" name="description" rows="4"
                                        class="block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('description') ring-1 ring-red-500 @enderror">{{ old('description', $category->description) }}</textarea>
                                </div>
                                @error('description')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <button type="submit" style="background-color: cornflowerblue;" class="inline-flex items-center px-4 py-2 hover:bg-indigo-700 text-white text-sm font-medium rounded-md shadow-sm">
                                        Update Category
                                    </button>

                                    <a href="{{ url()->previous() }}" class="inline-flex items-center px-3 py-2 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-sm rounded-md">
                                        Back
                                    </a>
                                </div>

                                <!-- Delete form is separate to avoid nested forms -->
                                {{-- <div>
                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Delete this category?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center px-3 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-md">
                                            Delete
                                        </button>
                                    </form>
                                </div> --}}
                            </div>
                        </form>
                    @else
                        <p class="text-sm text-gray-600 dark:text-gray-400">This page expects a category to be provided. Return to the dashboard and click a category to edit it.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
