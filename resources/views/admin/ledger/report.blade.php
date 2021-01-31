@extends('layouts.master')
@section('title')
    View Rojmel
@endsection
@section('content')
    <!-- Reference -->
    <div class="container">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div align="center" class="card-title">Summery {{ $start_date }} TO {{ $end_date }}</div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>Outward</th>
                                    <th></th>
                                    <th>Inward</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Loan</td>
                                    <td>{{ $loan }}</td>
                                    <td>Loan Installment </td>
                                    <td>{{ $loan_installment }}</td>
                                </tr>
                                <tr>
                                    <td>Expense</td>
                                    <td>{{ $expense }}</td>
                                    <td>Loan Paidup </td>
                                    <td>{{ $loan_paidup }}</td>
                                </tr>
                                <tr>
                                    <td>Medical Help</td>
                                    <td>{{ $help }}</td>
                                    <td>Return Medical </td>
                                    <td>{{ $help_return }}</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>Share Amount</td>
                                    <td>{{ $member_investment }}</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>Penalty Amount</td>
                                    <td>{{ $member_investment }}</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>Fees Amount</td>
                                    <td>{{ $member_investment }}</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                <td><b>Previous Amount</b></td>
                                    <td><b>{{ $onhand_amount }}</b></td>
                                </tr>
                                <tr>

                                    <td></td>
                                    <td></td>
                                    <td><b>Installment Amount</b></td>
                                    <td><b>{{ $t2 = $loan_installment + $loan_paidup + $help_return }}</b></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td><b>Total Inward Amount</b></td>
                                    <td><b>{{ $t3 = $t2 + $onhand_amount }}</b></td>
                                </tr>
                                <tr>
                                    <td><b>Total</b></td>
                                    <td><b>{{ $loan + $expense + $help + $member_investment }}</b></td>
                                    <td><b>Total Outward Amount</b></td>
                                    <td><b>{{ $t1 = $loan + $expense + $help + $member_investment }}</b></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>Cash On Hand</td>
                                    <td>{{ $t4 = $t3 - $t1 }}<b></b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    </div>
                </div>
            @endsection

            @section('scripts')
            @endsection
