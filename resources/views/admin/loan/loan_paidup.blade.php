@extends('layouts.master')
@section('title')
    Paidup Loan
@endsection

@section('content')
    <div class="container">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Loan Paidup
                        <a href="{{ url('role-installment') }}" class="btn btn-sm btn-success float-right">Back</a>
                    </h5>
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


                    <form action="{{ url('paid-loan') }}" method="POST">
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Enter Loan Number</label>
                                    <input type="text" id="loan_no" name="loan_no" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Loan Holder Name</label>
                                    <input type="text" id="name" name="name" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Loan ID</label>
                                    <input type="text" id="loan_id" name="loan_id" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Member ID</label>
                                    <input type="text" id="member_id" name="member_id" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Loan Date</label>
                                    <input type="text" id="loan_date" name="loan_date" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Loan Amount</label>
                                    <input type="text" id="loan_amount" name="loan_amount" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Profit</label>
                                    <input type="text" id="profit" name="profit" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Duration</label>
                                    <input type="text" id="duration" name="duration" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Paid Total Amount</label>
                                    <input type="text" id="paid_amount" name="paid_amount" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Paid Profit</label>
                                    <input type="text" id="paid_profit" name="paid_profit" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Paid</label>
                                    <input type="text" id="paid_inst" name="paid_inst" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Remaining</label>
                                    <input type="text" id="inst_remain" name="inst_remain" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Installment</label>
                                    <input type="text" id="inst_amount" name="inst_amount" class="form-control">
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Paidup Date</label>
                                    <input type="date" id="paidup_date" name="paidup_date" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Paidup Amount</label>
                                    <input type="text" id="paidup_amount" name="paidup_amount" value="0"
                                        class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Last Installment Paid</label>
                                    <input type="text" id="last_inst" name="last_inst" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="hidden" id="txt_inst_amount" name="txt_inst_amount" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="hidden" id="inst_profit" name="inst_profit" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <button type="submit" class="btn btn-info">Paid</button>
                            </div>

                    </form>

                </div>

            </div>
        </div>
    </div>

@endsection

@section('scripts')

<script>
        $(document).ready(function() {

            $("#loan_no").autocomplete({
                source: "{{ URL::to('/search') }}",
                dataType: 'json',
                async: true,
                timeout: 3000,
                select: function(key, value) {
                    console.log(value)


                    $('#name').val(value.item.name)
                    $('#loan_id').val(value.item.loan_id)
                    $('#member_id').val(value.item.member_id)
                    $('#loan_date').val(value.item.loan_date)

                    $('#loan_amount').val(value.item.loan_amount)
                    $('#profit').val(value.item.loan_profit)
                    $('#duration').val(value.item.loan_duration)
                    $('#reason').val(value.item.loan_reason)

                    $('#paid_amount').val(value.item.paid_loan_amt)
                    $('#paid_profit').val(value.item.paid_loan_profit)
                    $('#paid_inst').val(value.item.paid_inst)
                    $('#inst_remain').val(value.item.remain_inst)
                    $('#inst_amount').val(value.item.installment)

                    $('#txt_inst_amount').val(value.item.txt_inst_amt)
                    $('#inst_profit').val(value.item.inst_profit)
                    $('#last_inst').val(value.item.last_installment)

                }
            });
        });

    </script>
    <script type="text/javascript">
        $(".alert").delay(2000).slideUp(100, function() {
            $(this).alert('close');
        });

    </script>
@endsection
