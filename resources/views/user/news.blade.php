@extends('layouts.app')

@section('content')

    <div class="container-fluid bg-dark-subtle h-20 py-5">
        <div class="px-5 fs-2">
            News
        </div>
        <div class="px-5 fs-5">
            home
        </div>
    </div>

    {{-- <div class="px-5 py-3 h-20 container">
        <div style="max-height: 200px; overflow: hidden;">
        <img class=" img-fluid " src="https://images.theconversation.com/files/524157/original/file-20230503-1364-56rt5t.jpg?ixlib=rb-1.1.0&q=45&auto=format&w=1356&h=668&fit=crop">
        </div>
        <article class="blog-post">
        <h2 class="blog-post-title">Sample blog post</h2>
        <p class="blog-post-meta">January 1, 2021 by <a href="#">Mark</a></p>

        <p>This blog post shows a few different types of content that’s supported and styled with Bootstrap. Basic typography, lists, tables, images, code, and more are all supported as expected.</p>
        <hr>
        <p>This is some additional paragraph placeholder content. It has been written to fill the available space and show how a longer snippet of text affects the surrounding content. We'll repeat it often to keep the demonstration flowing, so be on the lookout for this exact same string of text.</p>
    </article>
    </div> --}}

    @foreach($news as $news2)

    <div class="px-5 py-3 h-20 container">
        <div style="max-height: 200px; overflow: hidden;">
        <a href="{{route('showberita',['title' => $news2->title, 'news2' => $news2])}}">
        @if($news2->news_image)
        <img class=" img-fluid " src="{{asset('storage/'.$news2->news_image)}}" alt="{{$news2->title}}">
        @else
        <img src="{{asset('images/imagenotfound.jpg')}}" alt="{{$news2->title}}" class="img-fluid">
        @endif
        </a>
        </div>
        <article class="blog-post">
        <h2  class="blog-post-title">
            <a style="text-decoration: none; color: inherit;" href="{{route('showberita',['title' => $news2->title, 'news2' => $news2])}}">
            {{$news2->title}}
            </a>
        </h2>
        {{-- <p class="blog-post-meta">{{$news2->created_at->format('d-M-Y')}}</p> --}}
        <p class="blog-post-meta">{{date('d-M-Y',strtotime($news2->created_at))}}</p>

        <p>{{$news2->content}}</p>
        <p><a style="text-decoration: none; color: inherit;" href="{{route('showberita',['title' => $news2->title, 'news2' => $news2])}}">read more</a></p>
        <hr>

    </article>
    </div>

    @endforeach
@endsection
