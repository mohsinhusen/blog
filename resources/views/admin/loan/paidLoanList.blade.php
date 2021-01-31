@extends('layouts.master')
@section('title')
    Paidup Loan
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="text-wrap float-right" style="width:autorem;">
                        Total No's of Paid Loan
                    </h5>
                    <a href="{{ url('dashboard') }}">
                        <button type="button" class="btn btn-sm btn-primary float-left py-1"><i
                                class="fas fa-arrow-left fa-0x" aria-hidden="true"></i></button></a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>No</i></th>
                                    <th>Name</th>
                                    <th>Loan Paid</i></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($paid_loan as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->member_id }}</td>
                                        <td><a
                                                href="{{ url('paid-loan-details/' . $item->member_id) }}">{{ $item->name }}</a>
                                        </td>
                                        <td>{{ $item->count_row }}</td>
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
                'Search Loan Holder Name ....').css({
                'width': '450px',
                'display': 'inline-block'
            });
        });

    </script>
@endsection
