@extends('layouts.master')
@section('title')
    Dashboard || Admin
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-warning card-header-icon">
                            <div class="dropdown">
                                <button type="button"
                                    class="btn btn-round float-right btn-outline-default dropdown-toggle btn-simple btn-icon no-caret"
                                    data-toggle="dropdown">
                                    <i class="now-ui-icons loader_gear"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href='{{ url('member') }}'>
                                        Member Investment
                                        <a class="dropdown-item" href='{{ url('non-member') }}'>Non-Member</a>
                                </div>
                            </div>
                            <p class="card-category"><i class="now-ui-icons users_single-02"> </i> Members</p>
                            <h5 class="card-title"> {{ $member }} || {{ $nonmember }}</a>
                                <small></small>
                            </h5>

                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-success card-header-icon">
                            <div class="dropdown">
                                <button type="button"
                                    class="btn btn-round float-right btn-outline-default dropdown-toggle btn-simple btn-icon no-caret"
                                    data-toggle="dropdown">
                                    <i class="now-ui-icons loader_gear"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href='{{ url('total-loan') }}'> Active Loan</a>
                                    <a class="dropdown-item" href='{{ url('paidup-loan') }}'> Paid Loan</a>
                                </div>
                            </div>
                            <p class="card-category"> <i class="now-ui-icons business_money-coins"> </i> Loan</p>
                            <h5 class="card-title"> {{ $loan }} || {{ $amt }}</h5>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-success card-header-icon">
                            <div class="dropdown">
                                <button type="button"
                                    class="btn btn-round float-right btn-outline-default dropdown-toggle btn-simple btn-icon no-caret"
                                    data-toggle="dropdown">
                                    <i class="now-ui-icons loader_gear"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href='{{ url('current-profit') }}'> Current Profit</a>
                                    <a class="dropdown-item" href='{{ url('received-profit') }}'> Received Profit</a>
                                    <a class="dropdown-item" href='{{ url('profit-wise') }}'> Profit </a>

                                </div>
                            </div>
                            <p class="card-category"> <i class="now-ui-icons business_money-coins"> </i> Profit</p>
                            <h5 class="card-title"> {{ $loan_cur_prft }}</h5>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-info card-header-icon">
                            <div class="dropdown">
                                <button type="button"
                                    class="btn btn-round float-right btn-outline-default dropdown-toggle btn-simple btn-icon no-caret"
                                    data-toggle="dropdown">
                                    <i class="now-ui-icons loader_gear"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href='{{ url('total-repay') }}'>Repay Installment</a>
                                    <a class="dropdown-item" href='{{ url('collect-repay') }}'>
                                        <span class="badge">{{ $total_repay }}</span> || Paid Installment || <span
                                            class="badge">{{ $collect_pay }}</span>
                                    </a>
                                    <a class="dropdown-item" href='{{ url('due-installment') }}'>
                                        Due Installment <span class="badge badge-danger"> {{ $unpaid }}</span>
                                    </a>
                                </div>
                            </div>
                            <p class="card-category">Repay Installment</p>
                            <h5 class="card-title"> {{ $loan_installment }}
                            </h5>
                        </div>
                    </div>
                </div>



                {{-- <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-danger card-header-icon">
                            <div class="dropdown">
                                <button type="button"
                                    class="btn btn-round float-right btn-outline-default dropdown-toggle btn-simple btn-icon no-caret"
                                    data-toggle="dropdown">
                                    <i class="now-ui-icons loader_gear"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href='{{ url('loan-applied') }}'>New Request Loan</a>
                                    <a class="dropdown-item" href='{{ url('total-loan') }}'>Non-Member</a>
                                </div>
                            </div>
                            <p class="card-category">Requested Loan</p>
                            <h5 class="card-title">{{ $total_loan_request }}
                            </h5>
                        </div>
                    </div>
                </div> --}}

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-danger card-header-icon">
                            <p class="card-category">Last Expense</p>
                            <h5 class="card-title"><a href='{{ url('view-expense') }}'> {{ $last_expense }}</a></h5>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-info card-header-icon">
                            <p class="card-category"><a href='{{ url('onhand-report') }}'>Cash On Hand</a></p>
                            <h5 class="card-title">{{ $total_in_cash }}</h5>
                        </div>
                    </div>
                </div> --}}

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-success card-header-icon">
                            <p class="card-category">Current Share Amount </p>
                            <h5 class="card-title">
                                {{ $total_amount_profit = $total_share_amt + $loan_cur_prft }}
                            </h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-danger card-header-icon">
                            <p class="card-category">Update Share</p>
                            <?php
                            $total_c_amount = ($total_share_amt + $loan_cur_prft) / $total_pshare;
                            if ($total_c_amount != 0) {
                            $total_c_amount = ($total_share_amt + $loan_cur_prft) / $total_pshare;
                            } else {
                            $total_c_amount = 0;
                            }
                            ?>
                            <h5 class="card-title">{{ round($total_c_amount, 2) }}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-info card-header-icon">
                            <p class="card-category">Total Share</p>
                            <h5 class="card-title">{{ $total_pshare }}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-success card-header-icon">
                            <p class="card-category"><a href='{{ url('/report-help') }}'>Medical Help</a>
                            </p>
                            <h5 class="card-title">
                                {{ $help }}
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        @endsection
        @section('scripts')
        @endsection
