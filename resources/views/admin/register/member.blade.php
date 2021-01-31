@extends('layouts.master')
@section('title')
    Member List || Add New Member
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
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

                <div class="card-body">

                    <h6 class="text-wrap text-center">
                        <a href="{{ url('dashboard') }}">
                            <button type="button" class="btn btn-sm btn-primary float-left py-2"><i <i
                                    class="now-ui-icons arrows-1_minimal-left"> </i></button></a>
                        Members
                        <a href='{{ url('create-member') }}' class="btn btn-sm btn-primary float-right">
                            <i class="now-ui-icons ui-1_simple-add"> </i></a>
                    </h6>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($member as $key => $item)
                                    <tr>
                                        <input type="hidden" class="serdelete_val_id" value="{{ $item->id }}">
                                        <td>{{ $item->id }}</td>
                                        @if ($item->role == 'member')
                                            <td><a href="{{ url('view-investment/' . $item->id) }}">{{ $item->name }}</a>
                                            </td>
                                        @else
                                            <td>{{ $item->name }}</td>
                                        @endif
                                        @if ($item->role == 'member')
                                            <td><span class="badge badge-primary">{{ $item->role }}</span></td>
                                        @else
                                            <td><span class="badge badge-success">{{ $item->role }}</span></td>
                                        @endif
                                        <td><a href="{{ url('role-investment/' . $item->id) }}"
                                                class="btn btn-sm btn-round btn-icon btn-primary">
                                                <i class="fas fa-plus fa-0x" aria-hidden="true"></i></a></td>
                                        <td><a href="{{ url('member-edit/' . $item->id) }}"
                                                class="btn btn-sm btn-round btn-primary btn-icon">
                                                <i class="now-ui-icons ui-2_settings-90"></i></a></td>
                                        <td><button type="button"
                                                class="btn btn-sm btn-round btn-primary btn-icon servideletebtn">
                                                <i class="fas fa-trash fa-0x" aria-hidden="true"></i></a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
                                                url: "{{ url('member-delete') }}" + '/' +
                                                    del_id,
                                                type: "DELETE",
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
                                'Search member name ....').css({
                                'width': '450px',
                                'display': 'inline-block'
                            });
                        });

                    </script>
                    <script type="text/javascript">
                        $(".alert").delay(2000).slideUp(100, function() {
                            $(this).alert('close');
                        });

                    </script>
                @endsection
