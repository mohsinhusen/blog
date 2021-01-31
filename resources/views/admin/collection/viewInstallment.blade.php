@extends('admin.collection.Layout.master')
@section('title')
    Loan Installment Summery || Admin
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <button type="button" class="btn btn-success float-right py-2" data-toggle="modal"
                        data-target="#addinstallment">Add Installment</button>

                    <a href="{{ url('active-loan') }}">
                        <button type="button" class="btn btn-success float-left py-2">Back</button></a>

                    <h4 align="center" class="card-title">Statement of {{ $installment_details->loan_type }} Loan </h4>
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
                                    <input type="hidden" class="serdelete_val_id" value="{{ $item->id }}">
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

    <div class="modal fade" id="addinstallment" tabindex="-1" role="dialog" aria-labelledby="addinstallment"
        aria-hidden="true">

        <form action="{{ url('add-installment/' . $id) }}" method="POST">
            {{ csrf_field() }}
            {{ method_field('PUT') }}

            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Installment</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="recipient-name" name="loan_id"
                                value="<?php echo $installment_details->loan_id; ?>">
                        </div>

                        <div class="form-group">
                            <input type="hidden" class="form-control" id="recipient-name" name="member_no"
                                value="<?php echo $installment_details->member_id; ?>">
                        </div>

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Installment Amount</label>
                            <input type="text" class="form-control" id="recipient-name" name="inst_amt"
                                value="<?php echo $installment_details->inst_amount; ?>">
                        </div>

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Installment Pay Date</label>
                            <input type="date" class="form-control" id="recipient-name" name="inst_date" required>
                        </div>

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Installment Status</label>
                            <select name="inst_status" class="form-control">
                                <option>Regluar</option>
                                <option>Late</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Installment Penalty</label>
                            <input type="number" class="form-control" id="recipient-name" value="0" name="inst_penalty"
                                required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Installment</button>
                    </div>
                </div>
            </div>
        </form>
    </div>


@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.servideletebtn').click(function(e) {
                e.preventDefault();
                var del_id = $(this).closest("tr").find('.serdelete_val_id').val();
                swal({
                        title: "Are you Sure ?",
                        text: "Once Deleted, You will not able to recover this Data!",
                        icon: "warning",
                        button: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            var data = {
                                "_token": $('input[name=_token]').val(),
                                "id": del_id,
                            };
                            $.ajax({
                                type: "DELETE",
                                url: '/installment-delete/' + del_id,
                                data: data,
                                success: function(response) {
                                    swal(response.status, {
                                            icon: "success",
                                        })
                                        .then((result) => {
                                            location.reload();
                                        });
                                }
                            });
                        }
                    });
            });
        });

    </script>
@endsection
