@extends('layouts.master')
@section('title')
    Loan Installment Summery || Admin
@endsection

@section('content')
<script>
    const export2Pdf = async () => {
      let printHideClass = document.querySelectorAll('.print-hide');
      printHideClass.forEach(item => item.style.display = 'none');
      await fetch('http://127.0.0.1:8000/export-pdf/id', {
        method: 'GET'
      }).then(response => {
        if (response.ok) {
          response.json().then(response => {
            var link = document.createElement('a');
            link.href = response;
            link.click();
            printHideClass.forEach(item => item.style.display='');
          });
        }
      }).catch(error => console.log(error));
    }
  </script>


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h6><a href="javascript:void(0)" class="nav-link" onclick="export2Pdf()">Download PDF</a>
                    </h6>
                    <h4 align="center" class="card-title">Statement of {{ $installment_details->loan_type }} Loan
                    </h4>
                </div>

                <div class="card-body">
                    <table class="table table-hover table-borderless table-responsive-sm ">
                        <tr>
                            <th>Name</th>
                            <th>:</th>
                            <th>{{ $installment_details->name }} </th>
                            <th></th>
                        <tr>
                            <th>Loan A/c No </th>
                            <th>:</th>
                            <th>{{ $installment_details->loan_no }}</th>
                            <th>Loan Paid Amount </th>
                            <th>:</th>
                            <th>{{ $total_paid_amount = $current_profit->paid_amount }}</th>
                        </tr>
                        <tr>
                            <th>LoanSnaction Amount</th>
                            <th>:</th>
                            <th>{{ $total_snaction_amount = $installment_details->loan_amt }}</th>
                            <th>Loan Paid Profit </th>
                            <th>:</th>
                            <th>{{ $current_profit->current_profit }}</th>
                        </tr>
                        <tr>
                            <th>Loan Profit</th>
                            <th>:</th>
                            <th>{{ $loan_profit = $installment_details->loan_profit }}</th>
                            <th>Loan Total Paid </th>
                            <th>:</th>
                            <th>{{ $total_loan_paid = $current_profit->totalpaid_amount }}</th>
                        </tr>
                        <tr>
                            <th>Loan Total</th>
                            <th>:</th>
                            <th>{{ $total_loan = $total_loan_amount = $installment_details->loan_amt + $installment_details->loan_profit }}
                            </th>
                            <th>Loan Reaming Amount </th>
                            <th>:</th>
                            <th>{{ $loan_ream = $total_loan_amount - $total_loan_paid }}</th>
                        </tr>
                        <tr>
                            <th>Loan Date</th>
                            <th>:</th>
                            <th>{{ $installment_details->loan_date }}</th>
                            <th>Paid Installment </th>
                            <th>:</th>
                            <th>{{ $total_paid_installment = $current_profit->total_paid_installment }}</th>
                        </tr>
                        <tr>
                            <th>Loan Loan Duration(M)</th>
                            <th>:</th>
                            <th>{{ $duration = $installment_details->loan_duration }}</th>
                            <th>Loan Due Installment </th>
                            <th>:</th>
                            <th>{{ $due_inst = abs($total_paid_installment - $installment_details->loan_duration) }}</th>
                        </tr>
                    </table>
                    <?php
                    $profit = $current_profit->current_profit;
                    $a = ($loan_profit / $duration) * $total_paid_installment + ($total_snaction_amount - $total_loan_paid);
                    ?>
                    <div class="card bg-secondary">
                        <div class="card-body text-center">
                            <h6>
                                <font color="white">Paidup Loan Amount : {{ round($a, 2) }}</font>
                            </h6>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive-sm">
                    <table class="table table-sm ">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Date</th>
                                <th>Installment</th>
                                <th>Remaining</th>
                            </tr>
                        </thead>
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
                    </table></div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
