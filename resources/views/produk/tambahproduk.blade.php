@extends('layouts.app')

@section('headscripts')
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection

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
    <form action="{{route('admin.tambahpro')}}" method="POST"  enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <img class = "img-preview img-fluid mb-3 col-sm-5">
            <input class="form-control" type="file" id="image" name="image" accept="image/jpg , image/png, image/jpeg" onchange="previewImage()">
          </div>
          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Name">
          </div>
          <div class="mb-3">
            <label for="sku" class="form-label">SKU</label>
            <input type="text" class="form-control" id="sku" name="sku" placeholder="SKU">
          </div>
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
            <select name="kategori" id="kategori" class="form-select" required>
                @foreach($kategori as $k)
                @if(old('kategori') == $k->id)
                <option value="{{$k->id}}" selected>{{$k->category_name}}</option>
                @else
                <option value="{{$k->id}}">{{$k->category_name}}</option>
                @endif
                @endforeach
            </select>
         </div>

          <div class="mb-3">
            <label for="tags" class="form-label">Tags</label>
            <input type="text" class="form-control" id="tags" name="tags" placeholder="Tags">
          </div>
          <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" class="form-control" id="description" name="description" placeholder="Description">
          </div>

        <button type="submit" class="btn btn-primary mt-3">Submit</button>
    </form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
function previewImage(){
    const image = document.querySelector('#image');
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
