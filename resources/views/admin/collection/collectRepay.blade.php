@extends('admin.collection.Layout.master')
@section('title')
    Total Collect Amount || Admin
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Total Collect Amount RePayment {{ $firstDayofPreviousMonth }} To
                        {{ $lastDayofPreviousMonth }}
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Loan</th>
                                <th>Name</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        @foreach ($collect_pay as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->member_id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->inst_amount }}</td>
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
@endsection
