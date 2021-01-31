@extends('layouts.master')
@section('title')Total Help || Admin
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Total Help
                        <a href='{{ url('role-help_create') }}' class="btn btn-sm btn-success float-right py-2">Add</a>
                    </h4>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            @foreach ($help as $key => $item)
                                <?php
                                $statuscheck = $item->status;
                                if ($statuscheck == 1) {
                                $status = 'Active';
                                } else {
                                $status = 'Paid';
                                }
                                ?>
                                <tr>
                                    <input type="hidden" class="serdelete_val_id" value="{{ $item->id }}">
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->help_name }}</td>
                                    <td>{{ $item->help_amount }}</td>
                                    <td>{{ $status }}</td>
                                    <td>
                                        <a href="{{ url('role-edit-help/' . $item->id) }}" class="btn btn-info">
                                            <i class="fas fa-edit fa-0x" aria-hidden="true"></i></a>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger servideletebtn">
                                            <i class="fas fa-trash fa-0x" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                                </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
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
                                url: '/delete-help/' + del_id,
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
