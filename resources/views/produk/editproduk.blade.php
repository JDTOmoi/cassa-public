@extends('layouts.app')

@section('content')

@if($errors->any())
<div class="alert alert-danger mx-3">
    <ul>
        @foreach($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="container mt-5">
    {{-- {{$produkedit->image}} --}}
    <form action="{{route('admin.updatepro', $produkedit)}}" method="POST"  enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            @if($produkedit->image)
            <br>
            <img class=" img-fluid " src="{{asset('storage/'.$produkedit->image)}}" alt="{{$produkedit->name}}">
            @else
            <img class = "img-preview img-fluid mb-3 col-sm-5">
            @endif
            <input class="form-control" type="file" id="image" name="image" accept="image/jpg , image/png, image/jpeg" onchange="previewImage()" value="{{$produkedit->image}}">
          </div>
          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{$produkedit->name}}">
          </div>
          <div class="mb-3">
            <label for="sku" class="form-label">SKU</label>
            <input type="text" class="form-control" id="sku" name="sku" placeholder="SKU" value="{{$produkedit->sku}}">
          </div>
          {{-- <div class="mb-3">
            <label for="brand" class="form-label">Brand</label>
            <input type="text" class="form-control" id="brand" name="brand" placeholder="Brand" value="{{$produkedit->brand}}">
          </div> --}}
          <div class="mb-3">
            <label for="brand" class = "form-label"> Brand</label>
            <select name="brand" id="brand" class="form-select" required>
                @foreach($brands as $brand)
                @if(old('brand') == $brand->id)
                <option value="{{$brand->id}}" selected>{{$brand->brand_name}}</option>
                @else
                <option value="{{$brand->id}}">{{$brand->brand_name}}</option>
                @endif
                @endforeach
            </select>
            </div>

            <div class="mb-3">
                <label for="kategori" class = "form-label">Kategori</label>
                <select name="kategori" id="brand" class="form-select" required>
                    @foreach($kategori as $k)
                    @if(old('kategori') == $k->id)
                    <option value="{{$kategori2->id}}" selected>{{$kategori2->category_name}}</option>
                    @else
                    <option value="{{$k->id}}">{{$k->category_name}}</option>
                    @endif
                    @endforeach
                </select>
            </div>

          <div class="mb-3">
            <label for="tags" class="form-label">Tags</label>
            <input type="text" class="form-control" id="tags" name="tags" placeholder="Tags" value="{{$produkedit->tags}}">
          </div>
          <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" class="form-control" id="description" name="description" placeholder="Description" value="{{$produkedit->description}}">
          </div>

        <button type="submit" class="btn btn-primary mt-3">Edit</button>
    </form>
    </div>

<script>
function previewImage(){
    const image = document.querySelector('image');
    const imgPreview = document.querySelector('.img-preview');

    imgPreview.style.display = 'block';

    const ofReader = new FileReader();
    ofReader.readAsDataURL(image.files[0]);

    ofReader.onload = function(oFREvent){
        imgPreview.src = oFREvent.target.result;
    }
}
</script>

@endsection
