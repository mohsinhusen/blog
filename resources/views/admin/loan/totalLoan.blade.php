@extends('layouts.master')
@section('title')
    Loan || Admin
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="text-wrap float-right" style="width:autorem;">
                        Total No's of Active Loan
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
                                    <th>Loan Holder Name</th>
                                    <th>Installment</th>
                                    <th>Active Loan</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($loan_no as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            <a href="{{ url('loanpersonaldetail/' . $item->member_id) }}">
                                                {{ $item->name }}</a>
                                        </td>
                                        <td>{{ $item->Totalinst }}</td>
                                        <td>{{ $item->count_row }}</td>
                                        <td>{{ $item->TotalLoan }}</td>
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
