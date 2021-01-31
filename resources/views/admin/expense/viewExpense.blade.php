@extends('layouts.master')
@section('title')Total Expenses || Admin
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Total Expenses
                        <a href='{{ url('new-expense') }}' class="btn btn-success float-right py-2">Add</a>
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Description</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        @foreach ($expense as $item)
                            <tr>
                                <input type="hidden" class="serdelete_val_id" value="{{ $item->id }}">
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->exp_date }}</td>
                                <td>{{ $item->exp_amount }}</td>
                                <td>{{ $item->exp_description }}</td>
                                <td>
                                    <a href="{{ url('edit-expense/' . $item->id) }}" class="btn btn-info">Edit</a>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger servideletebtn">Delete</a>
                                </td>
                            </tr>
                            </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.servideletebtn').click(function(e) {
                e.preventDefault();
                var del_id = $(this).closest("tr").find('.serdelete_val_id').val();
                swal({
                        title: "Are you Sure ?",
                        text: "Once Deleted, You will not able to recover this Data!",
                        icon: "warning",
                        button: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            var data = {
                                "_token": $('input[name=_token]').val(),
                                "id": del_id,
                            };
                            $.ajax({
                                type: "DELETE",
                                url: '/delete-expense/' + del_id,
                                data: data,
                                success: function(response) {
                                    swal(response.status, {
                                            icon: "success",
                                        })
                                        .then((result) => {
                                            location.reload();
                                        });
                                }
                            });
                        }
                    });
            });
        });

    </script>
@endsection
