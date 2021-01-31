@extends('admin.collection.Layout.master')
@section('title')
Pay Loan Installment || Admin
@endsection

@section('content')
<div class="container">    
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Pay Loan Installment  || Admin
                  
            </div>
                
            <div class="card-body">
                <form action="{{ url('') }}" method="POST">
                    {{ csrf_field() }}


                    <div class="col-md-8">
                        <div class="form-group">
                            <label>Select Loan No For Re-Pay Installment</label>
                            <select name="loan_id" class="form-control loanNo" required>
                                <option>Select Loan Holder For Re-Pay Installment</option>
                                @foreach ($installment_details as $item)
                                <option value="{{ $item->id }}">{{ $item->loan_no }}&nbsp;&nbsp;&nbsp;{{ $item->name }}</option>
                                @endforeach                                       
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label> Installment Amount</label>
                            <input type="text" id="inst_amt" name="inst_amt" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label> Installment Pay Date</label>
                            <input type="date" name="inst_date" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label> Installment Pay Status</label>
                                <select name="inst_status" class="form-control" required>
                                    <option>Regular</option>
                                    <option>Late</option>
                                </select>
                                </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label> Installment Penalty</label>
                            <input type="text" name="inst_penalty" class="form-control" required>
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

<script>

$(document).ready(function() {
    $(document).on('change', '.loanNo', function() {
        var l_no =  $(this).val();
        var token=$('input[name=_token]').val();        
        $.ajax({
            type: 'POST',
            url: '/getmember_id/',
            data: { 'id': l_no, '_token':token},
            dataType: 'json',
        }).done(function( msg ) {
//            console.log(msg.installment);
            $("#inst_amt").val(msg.installment);            
           // alert( msg );  
        });
    });
});
    </script>
@endsection
