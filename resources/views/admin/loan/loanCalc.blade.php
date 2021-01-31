@extends('layouts.master')

@section('title')
    Paidup Loan Calculator
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{ url('dashboard') }}">
                        <button type="button" class="btn btn-sm btn-primary float-left py-1"><i
                                class="fas fa-arrow-left fa-0x" aria-hidden="true"></i>
                        </button>
                    </a>
                    <h5 class="text-wrap float-right">
                        લોન ચૂકવણી કેલક્યુલેટર 1-1-2020
                    </h5>
                </div>
                <div class="card-body">
                    <div class="card card-nav-tabs card-plain">
                        <div class="card-header card-header-danger">
                            <form action="{{ url('#') }}" method="POST">
                                {{ csrf_field() }}

                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>લોન નંબર</label>
                                            <input type="text" id="loan_no" name="loan_no" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>નામ</label>
                                            <input type="text" id="name" name="name" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>લોન આઇ.ડી.</label>
                                            <input type="text" id="loan_id" name="loan_id" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>સભાસદ નંબર</label>
                                            <input type="text" id="member_id" name="member_id" class="form-control"
                                                required>
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>લોન નફો</label>
                                            <input type="number" name="loan_profit" class="form-control" id="loan_profit"
                                                required>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>લોન રકમ</label>
                                            <input type="number" name="loan_amount" class="form-control" id="loan_amount"
                                                required>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>કુલ રકમ</label>
                                            <input type="number" name="total_amount" class="form-control" id="total_amount"
                                                disabled>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>કુલ હપ્તા</label>
                                            <input type="text" name="loan_duration" class="form-control" id="loan_duration"
                                                required min="1" max="2">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>ભરેલ હપ્તા</label>
                                            <input type="text" name="paid_inst" class="form-control" id="paid_inst" required
                                                min="1" max="2">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>બાકી હપ્તા</label>
                                            <input type="text" name="remaining_inst" class="form-control"
                                                id="remaining_inst" disabled>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>વાપરેલ રકમ</label>
                                            <input type="text" name="use_amount" class="form-control" id="use_amount"
                                                disabled>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>મળેલ નફો</label>
                                            <input type="text" name="recieve_profit" class="form-control"
                                                id="recieve_profit" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>બાકી નફો</label>
                                            <input type="text" name="remain_profit" class="form-control" id="remain_profit"
                                                disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>બાકી રકમ</label>
                                            <input type="text" name="remain_amt" class="form-control" id="remain_amt"
                                                disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>મળેલ રકમ</label>
                                            <input type="text" name="recv_amt" class="form-control" id="recv_amt" disabled>
                                        </div>
                                    </div>
                                    {{-- <label>નફાના ટકા</label>
                                    --}}
                                    <input type="text" name="profit_percent" class="form-control" id="profit_percent"
                                        disabled hidden>
                                    <input type="text" name="profit_per" class="form-control" id="profit_per" disabled
                                        hidden>
                                    <input type="text" name="month_profit" class="form-control" id="month_profit" disabled
                                        hidden>
                                    <input type="text" name="group_profit" class="form-control" id="group_profit" disabled
                                        hidden>
                                    <input type="text" name="return_profit" class="form-control" id="return_profit" disabled
                                        hidden>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>નફા સાથે પરત કરવાની રકમ</label>
                                            <input type="text" name="return_profit_amt" class="form-control"
                                                id="return_profit_amt" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>પરત આપવાનો નફો</label>
                                            <input type="text" name="return_profit_1" class="form-control"
                                                id="return_profit_1" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>પરત કરવાની રકમ</label>
                                            <input type="text" name="return_amount" class="form-control" id="return_amount"
                                                disabled>
                                        </div>
                                    </div>
                                </div>
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
                            $('#loan_profit').val(value.item.loan_profit)
                            $('#loan_duration').val(value.item.loan_duration)
                            $('#paid_inst').val(value.item.paid_inst)

                        }
                    });
                });

            </script>

            <script>
                $(document).ready(function() {
                    $("#paid_inst").keydown(function() {

                        var loan_profit = parseInt($("#loan_profit").val(), 10);
                        var loan_amount = parseInt($("#loan_amount").val(), 10);

                        var total_loan = parseInt(loan_profit) + parseInt(loan_amount);
                        parseInt($("#total_amount").val(total_loan), 10);

                        var loan_duration = parseInt($("#loan_duration").val(), 10);
                        var paid_inst = parseInt($("#paid_inst").val(), 10);

                        var remaining_inst = parseInt(loan_duration) - parseInt(paid_inst);
                        parseInt($("#remaining_inst").val(remaining_inst), 10);

                        var use_amount = parseInt(total_loan) / parseInt(loan_duration) * parseInt(
                            paid_inst);
                        parseInt($("#use_amount").val(use_amount), 10);

                        var use_profit = parseInt(loan_profit) / parseInt(loan_duration) * parseInt(
                            paid_inst);
                        parseInt($("#recieve_profit").val(use_profit), 10);

                        var remaining_profit = parseInt(loan_profit) - parseInt(use_profit);
                        parseInt($("#remain_profit").val(remaining_profit), 10);

                        var remain_amount = parseInt(total_loan) - parseInt(use_amount);
                        parseInt($("#remain_amt").val(remain_amount), 10);

                        var rece_amount = parseInt(remain_amount) - parseInt(remaining_profit);
                        parseInt($("#recv_amt").val(rece_amount), 10);

                        var profit_percent = parseInt(loan_profit) / parseInt(loan_amount) * 100;
                        parseFloat($("#profit_percent").val(profit_percent), 10);

                        var profit_per = parseFloat(profit_percent) / parseInt(loan_duration) * 2;
                        parseFloat($("#profit_per").val(profit_per), 10);

                        var month_profit = (parseFloat(rece_amount) * (parseFloat(profit_per) / 100)) / 2;
                        parseInt($("#month_profit").val(month_profit), 10);

                        var group_profit = parseFloat(month_profit) * parseInt(paid_inst);
                        parseInt($("#group_profit").val(group_profit), 10);

                        var return_profit = parseInt(remaining_profit) - parseFloat(group_profit);
                        parseInt($("#return_profit").val(return_profit), 10);

                        parseInt($("#return_profit_amt").val(remain_amount), 10);
                        parseInt($("#return_profit_1").val(return_profit), 10);

                        var ret_profit = parseFloat(remain_amount) - parseFloat(return_profit);
                        parseFloat($("#return_amount").val(ret_profit), 10);

                    });
                });

            </script>
        @endsection
