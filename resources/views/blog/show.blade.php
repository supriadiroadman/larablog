@extends('layouts.blog')

@section('title')
{{ $post->title }}
@endsection


@section('header')

<header class="header text-white h-fullscreen pb-80"
    style="background-image: url({{ asset('storage/posts/'.$post->image) }});" data-overlay="9">
    <div class="container text-center">

        <div class="row h-100">
            <div class="col-lg-8 mx-auto align-self-center">

                <a href="{{ route('blog.category', $post->category) }}">
                    <p class="opacity-70 text-uppercase small ls-1">{{ $post->category->name }}</p>
                </a>
                {{-- <h1 class="display-4 mt-7 mb-8">{{ $post->title }}</h1> --}}
                <h3 class="ls-1 mt-7 mb-8">{{ $post->title }}</h3>
                <p><span class="opacity-70 mr-1">By</span> <a class="text-white"
                        href="{{ route('blog.author', $post->user) }}">{{ $post->user->name }}</a>
                </p>
                {{-- <p><img class="avatar avatar-sm" src="../assets/img/avatar/2.jpg" alt="..."></p> --}}

            </div>

            <div class="col-12 align-self-end text-center">
                <a class="scroll-down-1 scroll-down-white" href="#section-content"><span></span></a>
            </div>

        </div>

    </div>
</header>

@endsection


@section('content')
<main class="main-content">


    <!--
    |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
    | Blog content
    |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
    !-->
    <div class="section" id="section-content">
        <div class="container">

            <div class="row">
                <div class="col-lg-8 mx-auto">

                    {!! $post->content !!}

                </div>
            </div>

            <div class="row">
                <div class="col-lg-8 mx-auto">

                    <div class="gap-xy-2 mt-6">

                        @foreach ($post->tags as $tag)
                        <a class="badge badge-pill badge-secondary" href="{{ route('blog.tag', $tag) }}">
                            {{ $tag->name }}
                        </a>
                        @endforeach

                    </div>

                </div>
            </div>


        </div>
    </div>



    <!--
    |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
    | Comments
    |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
    !-->
    <div class="section bg-gray">
        <div class="container">

            <div class="row">
                <div class="col-lg-8 mx-auto">

                    <div class="media-list">
                        @php
                        $repliesCount = $post->comments->reduce(function ($count, $comment) {
                        return $count + $comment->replies->count();
                        }, 0);
                        @endphp

                        <h5> {{ $repliesCount + $post->comments->count() }} COMMENTS</h5>
                        @foreach ($post->comments as $comment)
                        <div class="media mt-5">
                            <img class="avatar avatar-sm mr-4" src="https://via.placeholder.com/50x50" alt="...">

                            <div class="media-body">
                                <div class="small-1">
                                    <strong>{{ $comment->user->name }}</strong>
                                    <time class="ml-4 opacity-70 small-3" datetime="2018-07-14 20:00">
                                        {{ $comment->created_at->diffForHumans() }}
                                    </time>
                                </div>
                                <p class="small-2 mb-0">{!! $comment->body !!}</p>
                            </div>
                            <button type="button" class="btn btn-link"
                                onclick="showReplyForm('{{ $comment->id }}', '{{ $comment->user->name }}')">Reply</button>
                        </div>


                        @foreach ($comment->replies as $reply)
                        <div class="media" style="margin-left: 55px">
                            <img class="avatar avatar-sm mr-4" src="https://via.placeholder.com/50x50" alt="...">

                            <div class="media-body">
                                <div class="small-1">
                                    <strong>{{ $reply->user->name }}</strong>
                                    <time class="ml-4 opacity-70 small-3" datetime="2018-07-14 20:00">
                                        {{ $reply->created_at->diffForHumans() }}
                                    </time>
                                </div>
                                <p class="small-2 mb-0">{{ $reply->body }}</p>
                            </div>
                            <button type="button" class="btn btn-link"
                                onclick="showReplyForm('{{ $comment->id }}', '{{ $reply->user->name }}')">Reply</button>
                        </div>
                        @endforeach


                        <form action="{{ route('comments.replies.store', $comment) }}" method="post">
                            @csrf
                            <div id="reply-form-{{ $comment->id }}" style="display: none; margin-left: 55px">
                                <div>
                                    <h5>{{ auth()->user()->name ?? '' }}</h5>
                                    <div class="form-group">

                                        <textarea id="reply-form-{{$comment->id}}-text" class="form-control"
                                            name="body_reply" rows="5"></textarea>
                                        @error('body_reply')
                                        <strong class="text-danger">
                                            {{$message}}
                                        </strong>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-primary">
                                        {{ Auth::check() ? 'Reply' : 'Login' }}
                                    </button>
                                </div>
                            </div>
                        </form>

                        @endforeach
                    </div>


                    <br>

                    <form action="{{ route('posts.comments.store', $post) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <textarea id="editor" name="body" class="form-control  @error('body') is-invalid @enderror"
                                placeholder="Comment" rows="4"></textarea>
                            @error('body')
                            <strong class="text-danger">
                                {{$message}}
                            </strong>
                            @enderror
                        </div>

                        <button class="btn btn-primary btn-block" type="submit">
                            {{ Auth::check() ? 'COMMENT' : 'Login' }}
                        </button>
                    </form>

                </div>
            </div>

        </div>
    </div>


</main>

@endsection

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script>

<script>
    ClassicEditor.create( document.querySelector( '#editor' ) )
                .then( editor => {
                    console.log( editor );
                } )
                .catch( error => {
                    console.error( error );
                 } );
  

    function showReplyForm(commentId,user) {
      var x = document.getElementById(`reply-form-${commentId}`);
      var input = document.getElementById(`reply-form-${commentId}-text`);

      if (x.style.display === "none") {
        x.style.display = "block";
        input.innerText=`@${user} `;

        var len = input.value.length;
        input.focus();
        input.setSelectionRange(len, len);

      } else {
        x.style.display = "none";
      }
    }
</script>
@endpush

@push('styles')
<style>
    .ck-editor__editable_inline {
        min-height: 150px;
    }
</style>
@endpush