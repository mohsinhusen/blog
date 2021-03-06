@extends('layouts.master')
@section('title')
    Current Profit || Admin
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="text-wrap float-right" style="width:autorem;">
                        {{ $c_profit }} : Current profit active loan
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
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($current_profit as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->loan_date }}</td>
                                        <td>{{ $item->member_id }}</td>
                                        <td><a href="{{ url('view-installment/' . $item->loan_id) }}">{{ $item->name }}</a>
                                        </td>
                                        @if ($item->status == 1)
                                            <td>
                                                {{ 'Paid' }}
                                            </td>
                                        @else
                                            <td>
                                                <div class="btn btn-sm btn-danger">{{ 'Active' }}</div>
                                            </td>
                                        @endif
                                        <td>{{ $item->loan_amount }}</td>
                                        <td>{{ $item->total_installment }}</td>
                                        <td>{{ $item->cur_profit }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
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
            $('#dataTable').DataTable({
                "searching": true, // false to disable search (or any other option),
                "pageLength": 5,
            });
            $('.dataTables_filter input[type="Search"]').attr('placeholder',
                'Search ....').css({
                'width': '450px',
                'display': 'inline-block'
            });
        });

    </script>
@endsection
