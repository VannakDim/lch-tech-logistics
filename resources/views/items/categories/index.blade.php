@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Item Categories</h1>
        <a href="{{ route('items-categories.create') }}" class="btn btn-primary">Create Category</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($categories->isEmpty())
        <div class="alert alert-secondary">No categories found.</div>
    @else
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th style="width: 60px;">#</th>
                        <th style="width: 100px;">Photo</th>
                        <th>Category Name</th>
                        <th>Description</th>
                        <th style="width: 180px;" class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>
                                @if($category->photo)
                                    <img src="{{ asset('storage/'.$category->photo) }}" alt="{{ $category->category_name }}" class="img-fluid" style="max-height:60px; object-fit:cover;">
                                @else
                                    <span class="text-muted small">No image</span>
                                @endif
                            </td>
                            <td>{{ $category->category_name }}</td>
                            <td class="text-muted" style="max-width:400px; white-space:pre-wrap;">{{ $category->description }}</td>
                            <td class="text-end">
                                <a href="{{ route('items-categories.show', $category->id) }}" class="btn btn-sm btn-outline-secondary">View</a>
                                <a href="{{ route('items-categories.edit', $category->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>

                                <form action="{{ route('items-categories.destroy', $category->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Delete this category? This action cannot be undone.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection