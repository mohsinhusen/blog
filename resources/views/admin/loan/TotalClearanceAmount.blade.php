@extends('layouts.master')
@section('title')
    Total Clearance Amount || Admin
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"> Total Clearance Amount
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th><i class="fa fa-indent" aria-hidden="true"></i></th>
                                <th><i class="fa fa-tasks" aria-hidden="true"></i></th>
                                <th><i class="fa fa-indent" aria-hidden="true"></i></th>
                                <th><i class="fa fa-user" aria-hidden="true"></i></th>
                                <th><i class="fa fa-inr" aria-hidden="true"></i></th>
                            </tr>
                        </thead>
                        @foreach ($TotalClearanceAmount as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->loan_no }}</td>
                                <td>{{ $item->member_id }}</td>
                                <td><a href="{{ url('view-installment/' . $item->id) }}">{{ $item->name }}</a></td>
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
