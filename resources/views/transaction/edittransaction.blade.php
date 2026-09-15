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
    <form action="{{route('admin.updatetss', $transactionedit)}}" method="POST">
        @method('put')
        @csrf
        <div class="mb-3">
            <label for="user_id" class = "form-label">Send to User</label>
            <select name="user_id" id="user_id" class="form-select" required>
                @foreach($users as $user)
                @if(old('user_id') == $user->id)
                <option value="{{$user->id}}">ID_{{$user->id}}: {{$user->name}}</option>
                @else
                <option value="{{$user->id}}">ID_{{$user->id}}: {{$user->name}}</option>
                @endif
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="amount_paid" class="form-label">Amount Paid</label>
            <input type="text" class="form-control" id="amount_paid" name="amount_paid" placeholder="Amount Paid" value="{{$transactionedit->amount_paid}}">
        </div>
        <div class="mb-3">
            <label for="tips" class="form-label">Tips</label>
            <input type="text" class="form-control" id="tips" name="tips" placeholder="Tips" value="{{$transactionedit->tips}}">
        </div>
        <button type="submit" class="btn btn-primary mt-3">Submit</button>
    </form>
</div>

@endsection