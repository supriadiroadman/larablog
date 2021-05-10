@extends('layouts.master')
@section('title', 'Create Posts')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h3 text-gray-800 d-inline-flex">Create</h1>
            <a href="{{ route('posts.index') }}" class="btn btn-sm btn-primary">Posts</a>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input name="title" type="text" class="form-control @error('title') is-invalid @enderror"
                            value="{{ old('title') }}">

                        @include('layouts.partials._error', [
                        'name' => 'title'
                        ])

                    </div>
                    <div class="form-group">
                        <label for="content">Content</label>
                        <textarea id="content" class="form-control @error('content') is-invalid @enderror"
                            name="content" rows="3">{{ old('content') }}</textarea>

                        @include('layouts.partials._error', [
                        'name' => 'content'
                        ])

                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input id="image" class="form-control-file" type="file" name="image">

                        @include('layouts.partials._error', [
                        'name' => 'image'
                        ])

                    </div>

                    <div class="form-group">
                        <label for="category_id">Category</label>
                        <select id="category_id" class="form-control" name="category_id">
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id') == $category->id  ? "selected" : "" }}>
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>

                        @include('layouts.partials._error', [
                        'name' => 'image'
                        ])

                    </div>
                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection