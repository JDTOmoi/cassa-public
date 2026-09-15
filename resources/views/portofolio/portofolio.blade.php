@extends('layouts.app')

@section('content')

    <div class="container-fluid bg-dark-subtle h-20 py-5">
        <div class="px-5 fs-2">
            Portofolio
        </div>
    </div>

    @if(Auth::user() && Auth::user()->isAdmin() !== null && Auth::user()->isAdmin())
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-9 col-sm-9 col-xs-8"></div> <!-- Adjusted column classes -->
            <div class="col-lg-3 col-sm-3 col-xs-4 d-flex justify-content-end"> <!-- Adjusted column classes -->
                <form method="GET" action="{{ route('admin.tambahport') }}" class="px-5 py-3">
                    <button class="btn btn-primary">
                        Tambah Portofolio
                    </button>
                </form>
            </div>
        </div>
    </div>

    @endif

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
          <a href="{{route('admin.showport',['title' => $port->title, 'port' => $port])}}" class="btn btn-primary">Read More</a>
        </div>
        @if(Auth::user() && Auth::user()->isAdmin() !== null && Auth::user()->isAdmin())
        <a href="{{ route('admin.editport', $port) }}">
            <button class='btn btn-warning my-2 mx-3' id="edit" name='edit'>Edit Portofolio</button>
        </a>


        <form action="{{ route('admin.hapusport', $port)}}" method="POST">
            @method('delete')
            @csrf
            <button class = 'btn btn-danger mx-3 my-2' id="delete" name='delete'>Hapus Portofolio</button>
        </form>
        @endif
    </div>
    @endforeach
    </div>
    {{-- </div> --}}

@endsection
