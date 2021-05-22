@extends('layouts.blog')

@section('title')
Welcome
@endsection

@section('header')
@php
$setting = App\Models\Setting::first();
@endphp


<header class="header text-center text-white"
    style="background-image: linear-gradient(-225deg, #003a91 0%, #0b539b 48%, #004683 100%);">
    <div class="container">

        <div class="row">
            <div class="col-md-8 mx-auto">

                <h1>
                    @if (isset($category))
                    {{ $category->name }}
                    @elseif (isset($tag))
                    {{ $tag->name }}
                    @elseif (isset($user))
                    {{ $user->name }}
                    @elseif (request()->query('search'))
                    {{ request()->query('search') }}
                    @else
                    {{ $setting->title }}
                    @endif
                </h1>
                <p class="lead-2 opacity-90 mt-6">{{ $setting->subtitle ?? 'Read and get updated on how we progress' }}
                </p>

            </div>
        </div>

    </div>
</header><!-- /.header -->

@endsection


@section('content')

<main class="main-content">
    <div class="section bg-gray">
        <div class="container">
            <div class="row">

                <div class="col-md-8 col-xl-9">
                    <div class="row gap-y">

                        @forelse ($posts as $post)
                        <div class="col-md-4 d-flex align-items-stretch">
                            <div class="card border hover-shadow-6 mb-6 d-block">
                                <a href="{{ route('blog.show', $post) }}">
                                    <img class="card-img-top" src="{{ asset('storage/posts/'.$post->image) }}"
                                        alt="Card image cap" style="width:100%; height: 30vh; object-fit: cover">
                                </a>

                                <div class="p-6 text-center">

                                    <div class="d-flex justify-content-around">
                                        <a class="small-5 text-uppercase ls-2 fw-400"
                                            href="{{ route('blog.author', $post->user) }}">
                                            <strong>By </strong>{{ $post->user->name }}
                                        </a>

                                        <a class="small-5 text-uppercase ls-2 fw-400"
                                            href="{{ route('blog.category', $post->category) }}">
                                            {{ $post->category->name }}
                                        </a>
                                    </div>

                                    <p>
                                        @foreach ($post->tags as $tag)
                                        <a class="small-5 text-lighter text-uppercase ls-1 fw-400 mr-2"
                                            href="{{ route('blog.tag', $tag) }}">
                                            {{ $tag->name }}
                                        </a>
                                        @endforeach
                                    </p>
                                    <h5 class="mb-0">
                                        <a class="text-dark" href="{{ route('blog.show', $post) }}">
                                            {{ Str::words($post->title, 10, '...') }}
                                        </a>
                                    </h5>
                                </div>
                            </div>
                        </div>
                        @empty
                        <h4>
                            No results for
                            <strong>'{{ request()->query('search') ?? $category->name ?? $tag->name}}'</strong>
                        </h4>
                        @endforelse

                    </div>

                    {{ $posts->links() }}

                </div>

                <div class="col-md-4 col-xl-3">
                    <div class="sidebar px-4 py-md-0">

                        <h6 class="sidebar-title">Search</h6>
                        <form class="input-group" action="{{ route('welcome') }}" method="GET">
                            <input type="text" class="form-control" name="search"
                                value="{{ request()->query('search') }}" placeholder="Search">
                            <div class="input-group-addon" onClick="document.forms[0].submit();"
                                style="cursor: pointer">
                                <span class="input-group-text"><i class="ti-search"></i></span>
                            </div>
                        </form>

                        <hr>

                        <h6 class="sidebar-title">Categories</h6>
                        <div class="row link-color-default fs-14 lh-24">
                            @foreach ($categories as $category)

                            <div class="col-md-12">
                                <a href="{{ route('blog.category', $category) }}">
                                    {{ $category->name }}
                                    <span
                                        class="badge badge-primary rounded-sm float-right">{{ $category->posts->count() }}</span>
                                </a>
                            </div>
                            @endforeach
                        </div>

                        <hr>
                        <hr>

                        <h6 class="sidebar-title">Tags</h6>
                        <div class="gap-multiline-items-1">

                            @foreach ($tags as $tag)
                            <a class="badge badge-secondary" href="{{ route('blog.tag', $tag) }}">
                                {{$tag->name}}
                            </a>
                            @endforeach

                        </div>

                        <hr>

                    </div>
                </div>

            </div>
        </div>
    </div>
</main>

@endsection