@extends('layouts.master')
@section('title')
    Applied Loan Current Month List || Admin
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Applied Loan Current Month List
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th><i class="fa fa-indent" aria-hidden="true"></i></th>
                                <th><i class="fa fa-user" aria-hidden="true"></i></th>
                                <th><i class="fa fa-calendar" aria-hidden="true"></i></th>
                                <th><i class="fa fa-inr" aria-hidden="true"></i></th>
                            </tr>
                        </thead>
                        @foreach ($total_loan_request as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->name }}</a></td>
                                <td>{{ $item->date }}</td>
                                <td>{{ $item->loan_amount }}</td>
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
