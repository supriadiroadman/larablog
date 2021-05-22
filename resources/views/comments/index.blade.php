@extends('layouts.master')
@section('title', 'Comments')

@section('mobileSearch')
<!-- Nav Item - Search Dropdown (Visible Only XS) -->
<li class="nav-item dropdown no-arrow d-sm-none">
    <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-search fa-fw"></i>
    </a>
    <!-- Dropdown - Messages -->
    <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
        <form action="" method="GET" class="form-inline mr-auto w-100 navbar-search">
            <div class="input-group">
                <input type="text" name="keyword" value="{{ request('keyword') }}"
                    class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search"
                    aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</li>
@endsection

@section('content')

@if($comments->count())
<div class="row">
    <div class="col">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h3 text-gray-800 d-inline-flex">Comments</h1>
            <div>
                <!-- Topbar Search -->
                <form action="" method="GET"
                    class="d-none d-sm-inline-block form-inline ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                    <div class="input-group">
                        <input type="text" name="keyword" value="{{ request('keyword') }}"
                            class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search"
                            aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>

        <div class="table-responsive-md">
            <table class="table table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Post Title</th>
                        <th>User Name</th>
                        <th>Body</th>
                        <th>Reply</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($comments as $comment)
                    <tr>
                        <td>{{ $loop->index + $comments->firstItem() }}</td>
                        <td>
                            <a href="{{ route('posts.show', $comment->post) }}">
                                {{ $comment->post->title }}
                            </a>
                        </td>
                        <td>{{ $comment->user->name }}</td>
                        <td>{!! $comment->body !!}</td>
                        <td>
                            @foreach ($comment->replies as $reply)
                            {!! $reply->body !!} <br>
                            @endforeach
                        </td>
                        <td>
                            <div class="d-flex">
                                {{-- Fungsi confirm delete berada di _sweetalert2 folder partials --}}
                                <form action="{{ route('comments.destroy', $comment) }}" method="post" id="form-delete">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" id="delete"
                                        data-name="{{$comment->name}}">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $comments->links() }}
    </div>
</div>
@else
<h3>Tidak ada data</h3>
@endisset

@endsection