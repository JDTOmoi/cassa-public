@extends('layouts.app')

@section('content')

    <div class="container-fluid bg-dark-subtle h-20 py-5">
        <div class="px-5 fs-2">
            {{$news->title}}
        </div>
    </div>

    <div style=" margin-left:20%;">
    <div class="px-5 py-5 h-20 container text-start" style="max-width: 60%;">
        <div style="max-height: 300px; overflow: hidden;" class="col-6">
        @if($news->news_image)
        <img class=" img-fluid " style="min-width:250px; width:100%;"src="{{asset('storage/'.$news->news_image)}}" alt="{{$news->title}}">
        @else
        <img src="{{asset('images/imagenotfound.jpg')}}" alt="{{$news->title}}" class="img-fluid">
        @endif
        </div>
        <hr>
        <article class="blog-post">
        <h2 class="blog-post-title">{{$news->title}}</h2>
        <hr>
        {{-- <p class="blog-post-meta">{{$news2->created_at->format('d-M-Y')}}</p> --}}
        <p class="blog-post-meta">{{date('d-M-Y',strtotime($news->created_at))}}</p>

        <p>{{$news->content}}</p>
    </article>
    </div>
    </div>


@endsection
