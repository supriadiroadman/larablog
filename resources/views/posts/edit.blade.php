@extends('layouts.master')
@section('title', 'Create Posts')

@section('content')
<div class="row">
    <div class="col">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h3 text-gray-800 d-inline-flex">Edit</h1>
            <a href="{{ route('posts.index') }}" class="btn btn-sm btn-primary">Posts</a>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input name="title" type="text" class="form-control @error('title') is-invalid @enderror"
                            value="{{ old('title') ?? $post->title }}">

                        @include('layouts.partials._error', [
                        'name' => 'title'
                        ])
                    </div>

                    <div class="form-group">
                        <label for="content">Content</label>
                        <textarea id="content" class="form-control @error('content') is-invalid @enderror"
                            name="content" rows="3">{{ old('content') ?? $post->content }} </textarea>

                        @include('layouts.partials._error', [
                        'name' => 'content'
                        ])
                    </div>

                    @if ($post->image)
                    <div class="form-group">
                        <label>Current Image</label>
                        <img src="{{ asset('storage/posts/'.$post->image) }}" style="max-height: 100px" alt=""
                            class="img-thumbnail d-block">
                    </div>
                    @endif

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
                        <select id="category_id" class="js-select2-single form-control" name="category_id">
                            <option value=""></option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ ( old('category_id') ?? $post->category_id) == $category->id ? 'selected':'' }}>
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
                        <select id="tag_id" class="js-select2-multiple form-control" name="tag_id[]" multiple>
                            @foreach ($tags as $tag)
                            <option value="{{ $tag->id }}"
                                {{ in_array($tag->id, old('tag_id', $post->tags->pluck('id')->toArray())) ? 'selected' : '' }}>
                                {{ $tag->name }}
                            </option>
                            @endforeach
                        </select>

                        @include('layouts.partials._error', [
                        'name' => 'tag_id'
                        ])
                    </div>

                    <button type="submit" class="btn btn-sm btn-primary">Update</button>
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