@extends('layouts.master')
@section('title', 'Edit settings')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h3 text-gray-800 d-inline-flex">Edit</h1>
            <a href="{{ route('settings.index') }}" class="btn btn-sm btn-primary">settings</a>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('settings.update', $setting) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name') ??  $setting->name }}">

                        @include('layouts.partials._error', [
                        'name' => 'name'
                        ])

                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Title</label>
                        <input name="title" type="text" class="form-control @error('title') is-invalid @enderror"
                            value="{{ old('title') ??  $setting->title }}">

                        @include('layouts.partials._error', [
                        'name' => 'title'
                        ])

                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Subtitle</label>
                        <input name="subtitle" type="text" class="form-control @error('subtitle') is-invalid @enderror"
                            value="{{ old('subtitle') ??  $setting->subtitle }}">

                        @include('layouts.partials._error', [
                        'name' => 'subtitle'
                        ])

                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Menu</label>
                        <input name="menu" type="text" class="form-control @error('menu') is-invalid @enderror"
                            value="{{ old('menu') ??  $setting->menu }}">

                        @include('layouts.partials._error', [
                        'name' => 'menu'
                        ])

                    </div>
                    <button type="submit" class="btn btn-sm btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection