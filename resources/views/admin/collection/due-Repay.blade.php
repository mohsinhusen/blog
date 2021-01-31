@extends('admin.collection.Layout.master')
@section('title')
    Total Due Installment
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Due Installment
                    </h5>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>loan No</th>
                                    <th>Name</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            @foreach ($result as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item['loan_no'] }}</td>
                                    <td><a href="{{ url('loan-installment/' . $item['loan_id']) }}">
                                            {{ $item['member_name'] }}
                                        </a></td>
                                    <td>{{ $item['loan_installment'] }}</td>
                                </tr>
                                </tbody>
                            @endforeach
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
                "pageLength": 20,
            });
        });

    </script>
@endsection
