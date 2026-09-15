@extends('layouts.app')

@section('content')
<div class="table-responsive">
<table class="table mx-3">
    <thead>
      <tr>
        <th scope="col">Transaction ID</th>
        <th scope="col">Amount Paid</th>
        <th scope="col">Tips</th>
        <th scope="col">Created at</th>
      </tr>
    </thead>
    <tbody>


    @foreach($transaction as $t)
    <tr>
        <td>{{$t->id}}</td>
        <td>{{$t->amount_paid}}</td>
        <td>{{$t->tips}}</td>
        <td>{{date("d-M-Y H:i",strtotime($t->created_at))}}</td>
    </tr>
    @endforeach


    </tbody>
</table>
</div>

@endsection