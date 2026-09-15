@extends('layouts.app')

@section('content')

<div class="ms-3">
<form method="GET" action="{{route('admin.tambahbrand')}}">
    <button class="btn btn-primary" href="{{route('admin.tambahbrand')}}">
        Daftar Brand
    </button>
</form>
</div>

<div class="table-responsive">

<table class="table mx-3">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Nama Merek</th>
        <th scope="col" colspan="2">Action</th>
      </tr>
    </thead>
    <tbody>

    @php($counter = 0)
    @foreach($brand as $b)
    @php($counter++)
    <tr>
        <td>{{$counter}}</td>
        <td>{{$b->brand_name}}</td>

        <td><a href="{{route('admin.editbrand',$b)}}"> <button class = 'btn btn-info' id="edit" name='edit'>Edit Brand</button> </a> </td>

        <td>
            <form action="{{ route('admin.hapusbrand', $b)}}" method="POST">
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
