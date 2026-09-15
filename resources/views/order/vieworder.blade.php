@extends('layouts.app')

@section('content')

<div class="table-responsive">
<table class="table mx-3">
    <thead>
      <tr>
        <th scope="col">Order ID</th>
        <th scope="col">User ID</th>
        <th scope="col">Order Message</th>
        <th scope="col">Nomor Telpon</th>
        <th scope="col">Product List</th>
        <th scope="col">Status</th>
        <th scope="col">Created At</th>
        <th scope="col" colspan="2">Action</th>
      </tr>
    </thead>
    <tbody>


    @foreach($order as $o)
    <tr>
        <td>{{$o->id}}</td>
        <td>{{$o->user_id}}</td>
        <td>{{$o->ord_message}}</td>
        <td>{{$o->phone_number}}</td>
        <td>
            <ul>
                @foreach($o->prs as $pr)
                    <li>{{$pr->quantity}} {{$pr->produk->name}}<br>
                    @if($pr->notes != null)
                        <i>({{$pr->notes}})</i>
                    @endif</li>
                @endforeach
            </ul>
        </td>
        <td>
            @if($o->status == 0)
            Queued
            @elseif($o->status == 1)
            Pending
            @elseif($o->status == 2)
            Arrived
            @endif
        </td>
        <td>{{date("d-M-Y H:i",strtotime($o->created_at))}}</td>
        <td>
            @if($o->status == 0)
            <form action="{{ route('hapusorder', $o)}}" method="POST">
                @method('delete')
                @csrf
                <button class = 'btn btn-danger' id="delete" name='delete'>Cancel</button>
            </form>
            @endif
        </td>

    </tr>
    @endforeach


    </tbody>
</table>

<a class="mx-3" href="https://wa.me/{{ env('WHATSAPP_NUMBER') }}?text=Hello">Discuss Order(s) on Whatsapp</a>
</div>

@endsection