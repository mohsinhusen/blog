@extends('layouts.master')
@section('title')
    Total Clearance Profit || Admin
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="text-wrap text-left text-monospace" style="width:autorem;">
                        Total Clearance Profit
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th><i class="fa fa-indent" aria-hidden="true"></i></th>
                                <th><i class="fa fa-tasks" aria-hidden="true"></i></th>
                                <th><i class="fa fa-indent" aria-hidden="true"></i></th>
                                <th><i class="fa fa-user" aria-hidden="true"></i></th>
                                <th><i class="fa fa-inr" aria-hidden="true"></i></th>
                            </tr>
                        </thead>
                        @foreach ($TotalClearanceProfit as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->loan_no }}</td>
                                <td>{{ $item->member_id }}</td>
                                <td><a href="{{ url('view-installment/' . $item->id) }}">{{ $item->name }}</a></td>
                                <td>{{ $item->loan_profit }}</td>
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
                                url: '/delete-loan/' + del_id,
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
