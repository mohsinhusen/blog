@extends('user.Layout.master')
@section('title')
    Loan Statement
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h6 align="center" class="card-title">Statement of {{ $installment_details->loan_type }} Loan
                    </h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive-sm">
                        <table class="table table-hover table-borderless">
                            <tr>
                                <th col scope="col">Name</th>
                                <th>:</th>
                                <th colspan="4" scope="col">
                                    <font color="blue">{{ $installment_details->name }}</font>
                                </th>
                                <th col scope="col"></th>
                            <tr>
                                <th col scope="col">Loan A/c</th>
                                <th>:</th>
                                <th col scope="col">{{ $installment_details->loan_no }}</th>
                                <th col scope="col">Received Amount </th>
                                <th>:</th>
                                <th col scope="col">{{ $total_paid_amount = $current_profit->paid_amount }}</th>
                            </tr>
                            <tr>
                                <th col scope="col">Amount</th>
                                <th>:</th>
                                <th col scope="col">{{ $total_snaction_amount = $installment_details->loan_amt }}</th>
                                <th col scope="col"> Received Profit </th>
                                <th>:</th>
                                <th col scope="col">{{ $current_profit->current_profit }}</th>
                            </tr>
                            <tr>
                                <th>Profit</th>
                                <th col scope="col">:</th>
                                <th col scope="col">{{ $loan_profit = $installment_details->loan_profit }}</th>
                                <th>Total Paid </th>
                                <th>:</th>
                                <th col scope="col">{{ $total_loan_paid = $current_profit->totalpaid_amount }}</th>
                            </tr>
                            <tr>
                                <th col scope="col">Total</th>
                                <th>:</th>
                                <th col scope="col">
                                    {{ $total_loan = $total_loan_amount = $installment_details->loan_amt + $installment_details->loan_profit }}
                                </th>
                                <th col scope="col">Surplus Amount </th>
                                <th>:</th>
                                <th col scope="col">
                                    <font color="red">
                                        {{ $loan_ream = $total_loan_amount - $total_loan_paid }}
                                    </font>
                                </th>

                            </tr>
                            <tr>
                                <th>Loan Date</th>
                                <th>:</th>
                                <th col scope="col">{{ $installment_details->loan_date }}</th>
                                <th>Received</th>
                                <th>:</th>
                                <th col scope="col">{{ $total_paid_installment = $current_profit->total_paid_installment }}
                                </th>
                            </tr>
                            <tr>
                                <th>Duration</th>
                                <th>:</th>
                                <th>{{ $duration = $installment_details->loan_duration }}</th>
                                <th>Unpaid</th>
                                <th>:</th>
                                <th>
                                    <font color="red">
                                        {{ $due_inst = abs($total_paid_installment - $installment_details->loan_duration) }}
                                    </font>
                                </th>
                            </tr>
                        </table>
                    </div>
                    <?php
                    $profit = $current_profit->current_profit;
                    $a = ($loan_profit / $duration) * $total_paid_installment + ($total_snaction_amount - $total_loan_paid);
                    ?>
                    <div class="alert alert-info alert-with-icon" data-notify="container">
                        <span data-notify="icon" class="now-ui-icons business_money-coins"></span>
                        <span data-notify="message">Paidup Amount : {{ round($a, 2) }}</span>
                    </div>

                    <table class="table table-sm ">
                        <?php $instalment_total = 0; ?>
                        @foreach ($installment_statement as $key => $item)
                            <?php $instalment_total += $item->inst_amount; ?>
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->inst_date }}</td>
                                <td>{{ $item->inst_amount }}</td>
                                <td>{{ $total_loan - $instalment_total }}</td>
                            </tr>
                            </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
@section('scripts')
@endsection
