@extends('layouts.master')
@section('title', 'Setting')


@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h3 text-gray-800 d-inline-flex">Setting</h1>
        </div>

        <div class="table-responsive-md">
            <table class="table table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Title</th>
                        <th>Subtitle</th>
                        <th>Menu</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>{{ $setting->name }}</td>
                        <td>{{ $setting->title }}</td>
                        <td>{{ $setting->subtitle }}</td>
                        <td>{{ $setting->menu }}</td>
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('settings.edit', $setting) }}"
                                    class="btn btn-sm btn-primary mr-1">Edit</a>
                                {{-- Fungsi confirm delete berada di _sweetalert2 folder partials --}}
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection