@extends('admin.collection.Layout.master')
@section('title')
    Total Loan || Admin
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Active Loan </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-borderless">
                            <tbody>
                                @foreach ($loan as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        {{-- <td>{{ $item->member_id }}</td>
                                        --}}
                                        <td><a href="{{ url('loan-installment/' . $item->id) }}">{{ $item->name }}</a></td>
                                        <td>{{ $item->loan_date }}</td>
                                        <td>{{ $item->loan_amt }}</td>
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
