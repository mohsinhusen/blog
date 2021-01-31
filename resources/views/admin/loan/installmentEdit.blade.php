@extends('layouts.master')
@section('title')
    Edit Installment || Admin
@endsection

@section('content')
    <div class="container">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Edit Loan Installment || Admin </h5>
                </div>
                <div class="card-body">
                    <form action="{{ url('installment-edit/' . $installment->id) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="col-md-4">
                            <div class="form-group">
                                <label> Installment Amount</label>
                                <input type="text" id="inst_amt" value="{{ $installment->inst_amount }}" name="inst_amt"
                                    class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label> Installment Pay Date</label>
                                <input type="date" name="inst_date" value="{{ $installment->inst_date }}"
                                    class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label> Installment Pay Status</label>
                                <select name="inst_status" class="form-control" value="{{ $installment->inst_status }}"
                                    required>
                                    <option>Regular</option>
                                    <option>Late</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label> Installment Penalty</label>
                                <input type="text" name="inst_penalty" value="{{ $installment->inst_penalty }}"
                                    class="form-control" required>
                            </div>
                        </div>


                        <div class="col-md-12">
                            <button type="submit" class="btn btn-info">Save</button>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>

@endsection

@section('scripts')

    {{-- <script>
        $(document).ready(function() {
            $(document).on('change', '.loanNo', function() {
                var l_no = $(this).val();
                var token = $('input[name=_token]').val();
                $.ajax({
                    type: 'POST',
                    url: '/getmember_detail/',
                    data: {
                        'id': l_no,
                        '_token': token
                    },
                    dataType: 'json',
                }).done(function(msg) {
                    $("#inst_amt").val(msg.installment);
                });
            });
        });

    </script> --}}
@endsection
