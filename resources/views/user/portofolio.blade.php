@extends('layouts.app')

@section('content')

    <div class="container-fluid bg-dark-subtle h-20 py-5">
        <div class="px-5 fs-2">
            Portofolio
        </div>
    </div>

    {{-- <div class="row px-4">
        <div class="card mx-4 my-4" style="width: 18rem;">
            <img class="card-img-top" src="..." alt="Card image cap">
            <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
        <div class="card mx-4 my-4" style="width: 18rem;">
            <img class="card-img-top" src="..." alt="Card image cap">
            <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
        <div class="card mx-4 my-4" style="width: 18rem;">
            <img class="card-img-top" src="..." alt="Card image cap">
            <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
        <div class="card mx-4 my-4" style="width: 18rem;">
            <img class="card-img-top" src="..." alt="Card image cap">
            <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
        <div class="card mx-4 my-4" style="width: 18rem;">
            <img class="card-img-top" src="..." alt="Card image cap">
            <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>

    </div> --}}


    <div class="row px-4">
    @foreach($port1 as $port)

    {{-- <div class="col-lg-4 col-md-6 col-sm-12"> --}}
    <div class="card mx-md-4 my-4 mx-sm-3" style="width: 18rem;">
        @if($port->port_image)
        <img class="card-img-top" src="{{asset('storage/'.$port->port_image)}}" alt="{{$port->port_image}}">
        @else
        <img src="{{asset('images/imagenotfound.jpg')}}" alt="{{$port->title}}" class="{{$port->port_image}}">
        @endif
        <div class="card-body">
          <h5 class="card-title">{{$port->title}}</h5>
          <p class="card-text">{{$port->content}}</p>
          <a href="{{route('showport',['title' => $port->title, 'port' => $port])}}" class="btn btn-primary">Read More</a>
        </div>
    </div>
    @endforeach
    </div>
    {{-- </div> --}}

@endsection
