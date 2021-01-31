@extends('user.Layout.master')
@section('title')
    Create New Member || Admin
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title"><i class="now-ui-icons files_paper"> </i> Request For New Loan
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ url('request-loan') }}" method="POST">
                        {{ csrf_field() }}

                        <div class="card">
                            <div class="card-body">
                                <form>
                                    <div class="form-group">
                                        <label>Select Type of Loan</label>
                                        <select name="loan_type" class="form-control">
                                            <option value="Muarabaha">Muarabaha</option>
                                            <option value="Karz-e-Hasna">Karz-e-Hasna</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Loan Reason</label>
                                        <select name="loan_reason" class="form-control">
                                            <option name="loan_reason" value="For Farming">
                                                For Farming</option>
                                            <option name="loan_reason" value="For Business">
                                                For Business</option>
                                            <option name="loan_reason" value="For Purchase Goods">
                                                For Purchase Goods</option>
                                            <option name="loan_reason" value="For Purchase Vehical">
                                                For Purchase Vehical</option>
                                            <option name="loan_reason"
                                                value="For purchase construction product for new house">
                                                For purchase construction product for new house</option>
                                            <option name="loan_reason" value="For Make New Bussiness">
                                                For Make New Bussiness</option>

                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Reason Loan</label>
                                        <input type="number" name="loan_amount" value="{{ old('loan_amount') }}"
                                            class="form-control" placeholder="Enter Loan Amount" required>
                                    </div>
                                    @error('loan_amount')
                                    <div class="alert-success"><strong>{{ $message }}</strong></span></div>
                                    @enderror
                                    <div class="form-group">
                                        <label>Loan Duration</label>
                                        <select name="loan_duration" class="form-control"
                                            value="{{ old('loan_duration') }}">
                                            <option value="24">24</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-info">Send Loan Request</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


        @endsection

        @section('scripts')
        @endsection
