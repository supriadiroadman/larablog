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
                        <div class="custom-file">
                            <label for="customFile" class="custom-file-label">Image</label>
                            <input id="customFile" class="custom-file-input" type="file" name="image">
                        </div>

                        @include('layouts.partials._error', [
                        'name' => 'image'
                        ])
                    </div>

                    <div class="form-group">
                        <label for="category_id">Category</label>
                        <select id="category_id"
                            class="js-select2-single form-control @error('category_id') is-invalid @enderror"
                            name="category_id">
                            <option value=""></option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id') == $category->id  ? "selected" : "" }}>
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>

                        @include('layouts.partials._error', [
                        'name' => 'category_id'
                        ])
                    </div>

                    <div class="form-group">
                        <label for="tag_id">Tags</label>
                        <select id="tag_id" class="js-select2-multiple form-control" name="tag_id[]"
                            multiple="multiple">
                            @foreach ($tags as $tag)
                            <option value="{{ $tag->id }}"
                                {{ (old('tag_id') != null && in_array($tag->id, old('tag_id'))) ? 'selected' : ''}}>
                                {{ $tag->name }}
                            </option>
                            @endforeach
                        </select>

                        @include('layouts.partials._error', [
                        'name' => 'tag_id'
                        ])
                    </div>

                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        // Select2
        $('.js-select2-single').select2({
         placeholder: 'Select an category',
         theme: "classic"
        });

        $('.js-select2-multiple').select2({
            placeholder: 'Select an tag',
            theme: "classic"
        });


        // Show name image after selected
        $('input[type="file"]').change(function(e){
            var fileName = e.target.files[0].name;
            $('.custom-file-label').html(fileName);
         });
});
</script>
@endpush