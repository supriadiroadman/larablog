@extends('layouts.master')
@section('title', 'Edit Tags')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h3 text-gray-800 d-inline-flex">Edit</h1>
            <a href="{{ route('tags.index') }}" class="btn btn-sm btn-primary">Tags</a>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('tags.update', $tag) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name') ??  $tag->name }}">

                        @include('layouts.partials._error', [
                        'name' => 'name'
                        ])

                    </div>
                    <button type="submit" class="btn btn-sm btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection