@extends('user.Layout.master')
@section('title')
    Member Activity Dashboard
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-warning card-header-icon">
                        {{-- <div class="card-icon">
                            <i class="material-icons">content_copy</i>
                        </div> --}}
                        <p class="card-category">Total Loan</p>
                        <h3 class="card-title">
                            {{ $total_loan }}
                            <small></small>
                        </h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">date_range</i>
                            <a href='{{ url('total-loans') }}'>View More</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-warning card-header-icon">
                        {{-- <div class="card-icon">
                            <i class="material-icons">content_copy</i>
                        </div> --}}
                        <p class="card-category">Investment</p>
                        <h3 class="card-title">
                            {{ $invest = $total_invest->invest_amount }}
                            <small></small>
                        </h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">date_range</i>
                            <a href='{{ url('summary-investment/' . Auth::guard('member')->user()->id) }}'>View More</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-danger card-header-icon">
                        <p class="card-category">Current Share Value</p>
                        {{-- <div class="card-icon">
                            <i class="material-icons">content_copy</i>
                        </div> --}}
                        <?php
                        $total_c_amount = ($total_share_amt + $loan_cur_prft) / $total_pshare;
                        if ($total_c_amount != 0) {
                        $total_c_amount = ($total_share_amt + $loan_cur_prft) / $total_pshare;
                        } else {
                        $total_c_amount = 0;
                        }
                        ?>
                        <h3 class="card-title">
                            {{ round($total_c_amount, 2) }}
                            <small></small>
                        </h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <p class="card-category"> Up to Date</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-warning card-header-icon">

                        <p class="card-category">Investment</p>
                        <h3 class="card-title">
                            {{ $total_invested = $total_invest->purchase_share * round($total_c_amount, 2) }}
                            <small></small>
                        </h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <p class="card-category"> Up to Date</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-warning card-header-icon">

                        <p class="card-category">Profit</p>
                        <h3 class="card-title">
                            {{ $total_invested - $invest }}
                            <small></small>
                        </h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <p class="card-category"> Up to Date</p>
                        </div>
                    </div>
                </div>
            </div>


        @endsection
        @section('scripts')
        @endsection
