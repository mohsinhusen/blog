@extends('layouts.master')
@section('title')
    Return Installment RePayment || Admin
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="text-center" style="width:autorem;">
                        તારીખ {{ $firstDayofPreviousMonth }} To
                        {{ $lastDayofPreviousMonth }}

                        માસિક કુલ હપ્તાની રકમ : {{ $loan_installment }}
                        <a href="{{ url('dashboard') }}">
                            <button type="button" class="btn btn-sm btn-primary float-left py-1"><i
                                    class="fas fa-arrow-left fa-0x" aria-hidden="true"></i></button></a>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</i></th>
                                <th>લોન નં</th>
                                <th>તારીખ</th>
                                <th>લોન લેનારનું નામ</th>
                                <th>હપ્તો</th>
                                <th>ચુકવેલ રકમ</th>
                                <th>ચુકવેલ હપ્તા</th>
                                <th>ચુકવેલ નફો</th>

                            </tr>
                        </thead>
                        @foreach ($total_repay as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->loan_date }}</td>
                                <td><a href="{{ url('view-installment/' . $item->id) }}">{{ $item->name }}</a></td>
                                <td>{{ $item->inst_amount }}</td>
                                <td>{{ $item->loan_amount }}</td>
                                <td>{{ $item->total_installment }}</td>
                                <td>{{ $item->cur_profit }}</td>
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
