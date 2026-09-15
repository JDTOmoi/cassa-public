@extends('layouts.app')

@section('content')

<div class="container-fluid bg-dark-subtle h-20 py-5">
        <div class="row">
            <div class="col-lg-2">
            </div>
            <div class="fs-2 col-lg-4">
                Detail Produk
            </div>
            <div class="col-lg-6">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2">
            </div>
            <div class="col-lg-4">
                <div class="fs-5">
                    {{$produk->name}}
                </div>
            </div>
            <div class="col-lg-6">
            </div>
        </div>
</div>

<div class="container-fluid my-5">
<div class ="row">
    <div class="col-sm-1">

    </div>
    <div class="col-sm-3">
        <div class="fs-3 my-3">Product Categories</div>
        @foreach($kategori1 as $k)

            @if($kategori == $k)
            <div class="fs-5 my-3" style="">
                <a href="{{ route('home', ['kategori' => $k->id]) }}" style="text-decoration:none; color:rgb(36, 144, 238)" class="">{{$k->category_name}}</a>
            </div>
            @else
            <div class="fs-5 my-3">
                <a href="{{ route('home', ['kategori' => $k->id]) }}" style="text-decoration:none; color:Black" class="">{{$k->category_name}}</a>
            </div>
            @endif
        @endforeach
    </div>
    <div style="overflow: hidden;" class="col-sm-4 my-5">
    @if($produk->image)
    <img class=" img-fluid " src="{{asset('storage/'.$produk->image)}}" alt="{{$produk->name}}">
    @else
    <img src="{{asset('images/imagenotfound.jpg')}}" alt="{{$produk->name}}" class="img-fluid">
    @endif
    </div>
    <div class="col-sm-4">
        <div class="fs-5">SKU: {{$produk->sku}}</div>
        <div class="fs-5">Category: {{$kategori->category_name}}</div>
        <div class="fs-5">Brand: {{$produk->BrandProduk->brand_name}}</div>
    </div>
</div>
</div>

<div class="container-fluid my-4">
    <div class="row">
        <div class="col-sm-3">

        </div>
        <div class="col-sm-9">
            <div class="fs-2">
                Description:
            </div>
            <div class="fs-4">
                <p>{{$produk->description}}</p>
            </div>
        </div>


    </div>
</div>

{{-- $lastProdCatas = $p->pcs()->latest()->first();
        if ($lastProdCatas) {
            $kategori2 = $lastProdCatas->category();
        } --}}

@endsection
