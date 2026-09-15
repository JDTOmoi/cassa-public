@extends('layouts.app')

@section('content')

    <div class="container-fluid bg-dark-subtle h-20 py-5">
        <div class="px-5 fs-2">
            Portofolio
        </div>
        <div class="px-5 fs-2">
            {{$port->title}}
        </div>
    </div>

    <div style=" margin-left:20%;">
    <div class="px-5 py-5 h-20 container text-start" style="max-width: 60%;">
        <div style="max-height: 300px; overflow: hidden;" class="col-6">
        @if($port->port_image)
        <img class=" img-fluid " style="min-width:250px; width:100%;"src="{{asset('storage/'.$port->port_image)}}" alt="{{$port->title}}">
        @else
        <img src="{{asset('images/imagenotfound.jpg')}}" alt="{{$port->title}}" class="img-fluid">
        @endif
        </div>
        <hr>
        <article class="blog-post">
        <h2 class="blog-post-title">{{$port->title}}</h2>
        <hr>
        {{-- <p class="blog-post-meta">{{$port2->created_at->format('d-M-Y')}}</p> --}}


        <p>{{$port->content}}</p>
    </article>
    </div>
    </div>


@endsection
