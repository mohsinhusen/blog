@extends('layouts.master')
@section('title')
    Due Installment
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="text-center" style="width:autorem;">
                        તારીખ {{ $firstDayofPreviousMonth }} To
                        {{ $lastDayofPreviousMonth }}
                        <br>
                        ચાલુ માસમાં ચુકવવાના બાકી હપ્તાની રકમ : {{ $due_pay }}
                        <a href="{{ url('dashboard') }}">
                            <button type="button" class="btn btn-sm btn-primary float-left py-1"><i
                                    class="fas fa-arrow-left fa-0x" aria-hidden="true"></i></button></a>
                    </div>

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</i></th>
                                <th>લોન નં</th>
                                <th>લોન લેનારનું નામ</th>
                                <th>રિમાર્ક</th>
                            </tr>
                        </thead>
                        @foreach ($result as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item['loan_id'] }}</td>
                                <td><a
                                        href="{{ url('view-installment/' . $item['loan_id']) }}">{{ $item['member_name'] }}</a>
                                </td>
                                <td><span class="badge badge-danger"> {{ 'હપ્તો બાકી' }}</span></td>
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
