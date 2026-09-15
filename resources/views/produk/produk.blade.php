@extends('layouts.app')

@section('content')
@if(Auth::user() && Auth::user()->isAdmin() !== null && Auth::user()->isAdmin())
<div class="ms-3">
<form method="GET" action="{{route('admin.tambahproduk')}}">
    <button class="btn btn-primary" href="{{route('admin.tambahproduk')}}">
        Tambah Produk
    </button>
</form>
</div>
@endif

<div class="table-responsive">

<table class="table mx-3">
    <thead>
      <tr>
        <th scope="col">Image</th>
        <th scope="col">Name</th>
        <th scope="col">SKU</th>
        <th scope="col">Brand</th>
        <th scope="col">Tags</th>
        <th scope="col">Description</th>
        <th scope="col" colspan="2">Action</th>
      </tr>
    </thead>
    <tbody>

    @php($counter = 0)
    @foreach($produk as $p)
    @php($counter++)
    <tr>
        <th scope="row">
            <div style="max-height: 200px; overflow: hidden;">
            @if($p->image)
            <img class=" img-fluid " src="{{asset('storage/'.$p->image)}}" alt="{{$p->name}}">
            @else
            <img src="{{asset('images/imagenotfound.jpg')}}" alt="{{$p->name}}" class="img-fluid">
            @endif
            </div>
        </th>
        <td>{{$p->name}}</td>
        <td>{{$p->sku}}</td>
        {{-- <td>{{$p->brand}}</td> --}}
        <td>{{$p->BrandProduk->brand_name}}</td>
        <td>{{$p->tags}}</td>
        <td>{{$p->description}}</td>

        <td><a href="{{route('admin.editproduk',$p)}}"> <button class = 'btn btn-info' id="edit" name='edit'>Edit Produk</button> </a> </td>

        <td>
            <form action="{{ route('admin.hapusproduk', $p)}}" method="POST">
                @method('delete')
                @csrf
                <button class = 'btn btn-danger' id="delete" name='delete'>Delete</button>
            </form>
        </td>

    </tr>
    @endforeach


    </tbody>
</table>

</div>

@endsection
