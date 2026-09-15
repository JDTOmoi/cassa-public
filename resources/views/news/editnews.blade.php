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
<form action="{{route('admin.updateberita', $newsedit)}}" method="POST" enctype="multipart/form-data">
@method('put')
@csrf
<div class="mb-3">
    <label for="news_image" class="form-label">Upload Image</label>
    @if($newsedit->news_image)
    <br>
    <img class=" img-fluid " src="{{asset('storage/'.$newsedit->news_image)}}" alt="{{$newsedit->title}}">

    @else

    <img class = "img-preview img-fluid mb-3 col-sm-5">
    @endif
    <input class="form-control" type="file" id="news_image" name="news_image" accept="image/jpg , image/png, image/jpeg" onchange="previewImage()">
</div>
<div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="{{$newsedit->title}}">
  </div>
  <div class="mb-3">
    <label for="content" class="form-label">Content</label>
    <input type="text" class="form-control" id="content" name="content" placeholder="Content" value="{{$newsedit->content}}">
  </div>


  {{-- <div class="mb-3">
    <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
  </div> --}}

<button type="submit" class="btn btn-primary mt-3">Edit</button>
</form>
</div>


<script>
function previewImage(){
    const image = document.querySelector('#news_image');
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
