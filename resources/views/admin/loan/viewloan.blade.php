@extends('layouts.master')
@section('title')
    Loan Installment Summery || Admin
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <button type="button" class="btn btn-success float-right py-2" data-toggle="modal"
                        data-target="#addinstallment"><i class="fas fa-plus fa-0x" aria-hidden="true"></i></button>

                    <a href="{{ url('total-loan') }}">
                        <button type="button" class="btn btn-success float-left py-2"><i class="fas fa-arrow-left fa-0x"
                                aria-hidden="true"></i></button></a>

                    <h4 align="center" class="card-title">Statement of {{ $installment_details->loan_type }} Loan </h4>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-primary alert-with-icon" data-notify="container">
                            <button type="button" aria-hidden="true" class="close">
                                <i class="now-ui-icons emoticons_satisfied"></i>
                            </button>
                            <span data-notify="icon" class="now-ui-icons ui-1_bell-53"></span>
                            <span data-notify="message">{{ session('status') }}</span>
                        </div>
                    @elseif(session('error'))
                        <div class="alert alert-danger alert-with-icon" data-notify="container">
                            <button type="button" aria-hidden="true" class="close">
                                <i class="now-ui-icons ui-1_simple-remove"></i>
                            </button>
                            <span data-notify="icon" class="now-ui-icons ui-1_bell-53"></span>
                            <span data-notify="message">{{ session('error') }}</span>
                        </div>
                    @endif
                    <table class="table table-hover table-borderless table-responsive-sm ">
                        <tr>
                            <th>Name</th>
                            <th>:</th>
                            <th colspan="3">{{ $installment_details->name }} </th>
                            <th></th>
                        <tr>
                            <th>Loan A/c No </th>
                            <th>:</th>
                            <th>{{ $installment_details->loan_no }}</th>
                            <th>Paid (A)</th>
                            <th>:</th>
                            <th>{{ $total_paid_amount = $current_profit->paid_amount }}</th>
                        </tr>
                        <tr>
                            <th>Amount</th>
                            <th>:</th>
                            <th>{{ $total_snaction_amount = $installment_details->loan_amt }}</th>
                            <th>Paid (P)</th>
                            <th>:</th>
                            <th>{{ $current_profit->current_profit }}</th>
                        </tr>
                        <tr>
                            <th>Profit</th>
                            <th>:</th>
                            <th>{{ $loan_profit = $installment_details->loan_profit }}</th>
                            <th>Total</th>
                            <th>:</th>
                            <th>{{ $total_loan_paid = $current_profit->totalpaid_amount }}</th>
                        </tr>
                        <tr>
                            <th>Total</th>
                            <th>:</th>
                            <th>{{ $total_loan = $installment_details->loan_amt + $installment_details->loan_profit }}
                            </th>
                            <th>Remaining </th>
                            <th>:</th>
                            <th>{{ $loan_ream = $total_loan - $total_loan_paid }}</th>
                        </tr>
                        <tr>
                            <th>Loan Date</th>
                            <th>:</th>
                            <th>{{ $installment_details->loan_date }}</th>
                            <th>Paid </th>
                            <th>:</th>
                            <th>{{ $total_paid_installment = $current_profit->total_paid_installment }}</th>
                        </tr>
                        <tr>
                            <th>Duration(M)</th>
                            <th>:</th>
                            <th>{{ $duration = $installment_details->loan_duration }}</th>
                            <th>Due </th>
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
                            <?php $instalment_total = 0; ?>
                            @foreach ($installment_statement as $key => $item)
                                <?php $instalment_total += $item->inst_amount; ?>
                                <tr>
                                    <input type="hidden" class="serdelete_val_id" value="{{ $item->id }}">
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->inst_date }}</td>
                                    <td>{{ $item->inst_amount }}</td>
                                    <td>{{ $total_loan - $instalment_total }}</td>
                                    <td><a href="{{ url('installment-edit-view/' . $item->id) }}"
                                            class="btn btn-info btn-sm">
                                            <i class="fas fa-edit fa-0x" aria-hidden="true"></i></a></td>
                                    <td><button type="button" class="btn btn-danger btn-sm servideletebtn">
                                            <i class="fas fa-trash fa-0x" aria-hidden="true"></i></a></td>
                                </tr>
                                </tbody>
                            @endforeach
                        </table>
                    </div>
                    <a href="{{ url('export-pdf/' . $id) }}">
                        <button type="button" class="btn btn-primary float-right"><i class="fas fa-file-pdf fa-0x"
                                aria-hidden="true"></i></button></a>
                    <button type="button" class="btn btn-primary  float-right" data-toggle="modal"
                        data-target="#exampleModal"><i class="fas fa-credit-card fa-0x" aria-hidden="true"></i></a></button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addinstallment" tabindex="-1" role="dialog" aria-labelledby="addinstallment"
        aria-hidden="true">

        <form action="{{ url('installment-store-model/' . $id) }}" method="POST">
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
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-minus"
                                aria-hidden="true"></i></button>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-plus fa-0x"
                                aria-hidden="true"></i></button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <form action="{{ url('paidup-loan/' . $id) }}" method="POST">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Enter Paidup Amount</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="loan_id" value="<?php echo $id; ?>">
                        <label>Amount</label>
                        <input type="text" id="paidup_amount" name="paidup_amount"
                            value="<?php echo round($a, 2); ?>" class="form-control"
                            required>
                        <label>Amount</label>
                        <input type="date" id="paidup_date" name="paidup_date" class="form-control" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Paidup</button>
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
                                url: "{{ url('installment-delete') }}" + '/' + del_id,
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
