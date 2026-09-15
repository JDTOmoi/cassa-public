@extends('layouts.app')

@section('content')

<div class="table-responsive">
<form id="updateStatusForm" method="POST" action="{{ route('admin.updateord') }}">
    @csrf
    @method('put')
    <input type="hidden" name="order_statuses" id="orderStatusesInput" value="">
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
            @php($statuses = ["Queued", "Pending", "Arrived"])
            @php($counter = 0)
            <select name="status[]" id="status" class="form-select" required onchange="updateOrderStatus(this, {{ $o->id }})">
                @foreach($statuses as $s)
                @if($o->status == $counter)
                <option value="{{$counter}}" selected>{{$s}}</option>
                @else
                <option value="{{$counter}}">{{$s}}</option>
                @endif
                @php($counter++)
                @endforeach
            </select>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
@csrf
@method('put')
<button type="button" class="btn btn-primary" onclick="submitStatusUpdateForm()">Update Status</button>
<form>
</div>

<script>
    var selectedOrders = [];

    function updateOrderStatus(selectElement, orderId) {
        var selectedStatus = selectElement.value;
        if (selectedStatus !== "") {
            selectedOrders.push({ id: orderId, status: selectedStatus });
        }
    }

    function submitStatusUpdateForm() {
        document.getElementById('orderStatusesInput').value = JSON.stringify(selectedOrders);
        document.getElementById('updateStatusForm').submit();
    }
</script>

@endsection