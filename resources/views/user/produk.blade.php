@extends('layouts.app')

@section('content')

<table class="table mx-3">
    <thead>
      <tr>
        <th scope="col">Image</th>
        <th scope="col">Name</th>
        <th scope="col">SKU</th>
        <th scope="col">Brand</th>
        <th scope="col">Tags</th>
        <th scope="col">Description</th>
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
    </tr>
    @endforeach


    </tbody>
</table>

@endsection
