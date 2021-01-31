@extends('admin.collection.Layout.master')
@section('title')
    Sub Admin || Dashboard
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-warning card-header-icon">
                        <p class="card-category"><a href='{{ url('active-loan') }}'>Active Loans</a></p>
                        <h3 class="card-title">
                            {{ $total_active_loan }}
                            <small></small>
                        </h3>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-warning card-header-icon">
                        <p class="card-category">Total Return Installment</p>
                        <h3 class="card-title">
                            {{ $total_return_installment }}
                            <small></small>
                        </h3>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-info card-header-icon">
                        <p class="card-category"><a href='{{ url('collection-repay') }}'>Installment Paid</a> </p>
                        <h3 class="card-title"> {{ $collect_pay }} || {{ $total_repay }} </h3>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-info card-header-icon">
                        <p class="card-category"><a href='{{ url('collection-due') }}'>Due Installment</a></p>
                        <h3 class="card-title">{{ $due_pay }} || {{ $unpaid }} </h3>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @section('scripts')
    @endsection
