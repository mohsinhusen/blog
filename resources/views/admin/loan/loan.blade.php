@extends('layouts.master')
@section('title')
    Loan Holder Lsit || New Loan
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-primary alert-with-icon" data-notify="container">
                            <button type="button" aria-hidden="true" class="close">
                                <i class="now-ui-icons emoticons_satisfied"></i>
                            </button>
                            <span data-notify="icon" class="now-ui-icons ui-1_bell-53"></span>
                            <span data-notify="message">{{ session('status') }}</span>
                        </div>
                    @elseif(session('error'))
                        <div class="alert alert-danger alert-with-icon" data-notify="container">
                            <button type="button" aria-hidden="true" class="close">
                                <i class="now-ui-icons ui-1_simple-remove"></i>
                            </button>
                            <span data-notify="icon" class="now-ui-icons ui-1_bell-53"></span>
                            <span data-notify="message">{{ session('error') }}</span>
                        </div>
                    @endif

                    <h6 class="text-wrap text-center">
                        <a href="{{ url('dashboard') }}">
                            <button type="button" class="btn btn-sm btn-primary float-left"><i
                                    class="now-ui-icons arrows-1_minimal-left"> </i></button></a>
                        ટોટલ લોન
                        <a href='{{ url('new-loan') }}' class="btn btn-sm btn-primary float-right">
                            <i class="now-ui-icons ui-1_simple-add"> </i></a>
                    </h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>સભાસદ નં</th>
                                    <th>લોન નં</th>
                                    <th>લોન લેનારનું નામ</th>
                                    <th>લોન તારીખ</th>
                                    <th>લોનની રકમ</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($loan as $key => $item)
                                    <tr>
                                        <input type="hidden" class="serdelete_val_id" value="{{ $item->id }}">
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->member_id }}</td>
                                        <td>{{ $item->id }}</td>
                                        <td><a href="{{ url('view-installment/' . $item->id) }}"> {{ $item->name }} </a>
                                        </td>
                                        <td>{{ $item->loan_date }}</td>
                                        <td>{{ $item->loan_amt }}</td>
                                        <td>
                                            <a href="{{ url('edit-loan/' . $item->id) }}"
                                                class="btn btn-sm btn-round btn-primary btn-icon">
                                                <i class="fas fa-edit fa-0x" aria-hidden="true"></i></a>
                                        </td>
                                        <td><button type="button"
                                                class="btn btn-sm btn-round btn-primary btn-icon servideletebtn">
                                                <i class="fas fa-trash fa-0x" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
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
                                    url: "{{ url('delete-loan') }}" + '/' + del_id,
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

        <script>
            $(document).ready(function() {
                $('#dataTable').DataTable({
                    "searching": true, // false to disable search (or any other option),
                    "pageLength": 5,
                });
                $('.dataTables_filter input[type="Search"]').attr('placeholder',
                    'Search Loan Holder Name ....').css({
                    'width': '450px',
                    'display': 'inline-block'
                });
            });

        </script>
        <script type="text/javascript">
            $(".alert").delay(3000).slideUp(200, function() {
                $(this).alert('close');
            });
        </script>
    @endsection
