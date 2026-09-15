@extends('layouts.app')

@section('content')

<div class="ms-3">
<form method="GET" action="{{route('admin.tambahtransaction')}}">
    <button class="btn btn-primary" href="{{route('admin.tambahtransaction')}}">
        Kirim Transaksi
    </button>
</form>
</div>

<div class="table-responsive">
<table class="table mx-3">
    <thead>
      <tr>
        <th scope="col">Transaction ID</th>
        <th scope="col">User ID</th>
        <th scope="col">Amount Paid</th>
        <th scope="col">Tips</th>
        <th scope="col">Created at</th>
        <th scope="col" colspan="2">Action</th>
      </tr>
    </thead>
    <tbody>


    @foreach($transaction as $t)
    <tr>
        <td>{{$t->id}}</td>
        <td>{{$t->user_id}}</td>
        <td>{{$t->amount_paid}}</td>
        <td>{{$t->tips}}</td>
        <td>{{date("d-M-Y H:i",strtotime($t->created_at))}}</td>

        <td><a href="{{route('admin.edittransaction',$t)}}"> <button class = 'btn btn-info' id="edit" name='edit'>Edit</button> </a> </td>

        <td>
            <form action="{{ route('admin.hapustransaction', $t)}}" method="POST">
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