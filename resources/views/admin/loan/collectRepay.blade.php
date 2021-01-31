@extends('layouts.master')
@section('title')
    Installment Payment || Admin
@endsection

@section('content')
    
    <form id="myFormId">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="text-center" style="width:autorem;">
                        તારીખ {{ $firstDayofPreviousMonth }} To
                        {{ $lastDayofPreviousMonth }}
                        ભરેલ હપ્તાની યાદી
                       
                        <a href="{{ url('dashboard') }}">
                            <button type="button" class="btn btn-sm btn-primary float-left py-1"><i
                                    class="fas fa-arrow-left fa-0x" aria-hidden="true"></i></button></a>
                    </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>#</i></th>
                                    <th>લોન નં</th>
                                    <th>લોન લેનારનું નામ</th>
                                    <th>માસિક હપ્તો</th>
                                    <th>તારીખ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($collect_pay as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->loan_no }}</td>
                                        <td><a href="{{ url('view-installment/' . $item->loan_id) }}">{{ $item->name }}</a>
                                        </td>
                                        <td>{{ $item->inst_amount }}</td>
                                        <td>{{ $item->inst_date }}</td>

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
