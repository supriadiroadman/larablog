@extends('layouts.master')
@section('title', $post->title)

@section('content')

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header bg-primary text-white">
                Detail {{ $post->title }}
            </div>
            <div class="card-body bg-light">
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>
                                    <strong>Title</strong>
                                </td>
                                <td>{{$post->title}}</td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Author</strong>
                                </td>
                                <td>{{$post->user->name}}</td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Content</strong>
                                </td>
                                <td>
                                    {!! $post->content !!}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Category</strong>
                                </td>
                                <td>{{ $post->category->name }}</td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Tags</strong>
                                </td>
                                <td>{{ $post->tags->pluck('name')->implode(', ') }}</td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Image</strong>
                                </td>
                                <td><img src="{{ asset('/storage/posts/'.$post->image) }}" alt="" class="img-thumbnail">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection