@extends('layouts.master')
@section('title')
    Member Investment
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Member Investment : {{ $total_share_amt }}
                        Member Share : {{ $total_pshare }}</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Member No</th>
                                    <th>Name</th>
                                    <th>Share</th>
                                    <th>Investment</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($member as $key => $item)
                                    <tr>
                                        <input type="hidden" class="serdelete_val_id" value="{{ $item->id }}">
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->id }}</td>
                                        <td><a href="{{ url('view-investment/' . $item->id) }}">{{ $item->name }}</a></td>
                                        <td>{{ $item->p_share }}</td>
                                        <td>{{ $item->current_amount }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "searching": true, // false to disable search (or any other option),
                "pageLength": 5,
            });
            $('.dataTables_filter input[type="Search"]').attr('placeholder',
                'Search Member Name ....').css({
                'width': '450px',
                'display': 'inline-block'
            });
        });

    </script>
@endsection
