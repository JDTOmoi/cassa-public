@extends('layouts.app')

@section('headstrings')

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
<form action="{{route('admin.tambahord')}}" method="POST">
    @csrf
    <div class="mb-3">
            <label for="image" class="form-label">Order Message</label>
            <input type="text" class="form-control" id="ord_message" name="ord_message" placeholder="Order Message">
          </div>
          <div class="mb-3">
            <label for="image" class="form-label">Nomor Telpon</label>
            <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Nomor telepon">
          </div>
    <table id="dataTable" class="mx-auto">
        <tr>
            <th class="px-4">Product</th>
            <th class="px-4">Quantity</th>
            <th class="px-4">Notes</th>
            <th class="px-4"></th>
        </tr>
        <tr>
            <td class="px-4">
                <select name="produk_id[]" id="produk_id" class="form-select" required>
                    @foreach($produks as $produk)
                    @if(old('produk_id[]') == $produk->id)
                    <option value="{{$produk->id}}" selected>{{$produk->name}}</option>
                    @else
                    <option value="{{$produk->id}}">{{$produk->name}}</option>
                    @endif
                    @endforeach
                </select>
            </td>

            <td class="px-4"><input type="number" name="quantity[]" min="1" class="form-control" required></td>
            <td class="px-4"><input type="text" name="notes[]"  class="form-control"></td>
            <td><button type="button" id="removeButton">Remove</button></td>
        </tr>
    </table>
    <button type="button" id="addButton">Add Row</button>
    <button type="submit">Order</button>
</form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>

    $(document).ready(function () {
        $("#addButton").on("click", function () {
            addRow();
        });

        $("#removeButton").on("click", "button", function () {
            removeRow($(this));
        });
    });

    function addRow() {
        var table = $("#dataTable");
        var newRow = $("<tr>").appendTo(table);
        var columns = 3;

        for (var i = 0; i < columns; i++) {
            var cell = $("<td>").addClass("px-4").appendTo(newRow);

            if (i == 0) {
                var input = $("<select>")
                    .attr("name", "produk_id[]")
                    .addClass("form-select")
                    .prop("required", true);

                var produks = <?= json_encode($produks); ?>;
                $.each(produks, function (index, value) {
                    var option = $("<option>")
                        .val(value.id)
                        .text(value.name);
                    input.append(option);
                });

                cell.append(input);
            } else if (i == 1) {
                var input2 = $("<input>")
                    .attr("type", "number")
                    .attr("name", "quantity[]")
                    .addClass("form-control")
                    .on("input", function () {
                        if (parseInt(input2.val()) < 1) {
                            input2.val(1);
                        }
                    })
                    .prop("required", true);
                cell.append(input2);
            } else if (i == 2) {
                var input3 = $("<input>")
                    .attr("type", "text")
                    .attr("name", "notes[]")
                    .addClass("form-control");
                cell.append(input3);
            }
        }

        var actionCell = $("<td>").appendTo(newRow);
        var removeButton = $("<button>")
            .attr("type", "button")
            .text("Remove")
            .on("click", function () {
                removeRow($(this));
            });
        actionCell.append(removeButton);
    }

    function removeRow(button) {
        var row = button.closest("tr");
        var inputs = row.find("input");
        
        inputs.val("");

        row.remove();
    }
</script>

@endsection