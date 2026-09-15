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
    <form action="{{route('admin.updatectg', $categoryedit)}}" method="POST">
        @method('put')
        @csrf
        <div class="mb-3">
            <label for="category_name" class="form-label">Nama Kategori</label>
            <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Nama Kategori" value="{{$categoryedit->category_name}}">
        </div>
        <button type="submit" class="btn btn-primary mt-3">Edit</button>
    </form>
</div>
@endsection