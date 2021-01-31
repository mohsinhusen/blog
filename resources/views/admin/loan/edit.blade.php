@extends('layouts.master')
@section('title')
    Edit Loan || Admin
@endsection

@section('content')

@section('content')
    <div class="container">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{ url('role-loan') }}">
                        <button type="button" class="btn btn-sm btn-primary">
                            <i class="now-ui-icons arrows-1_minimal-left"> </i> </button></a>
                    <h5 class="card-title float-right">
                        <i class="now-ui-icons ui-2_settings-90"> || </i> {{ $loan->name }}
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ url('role-edit-loan/' . $member->id) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Type of Loan</label>
                                    <select name="loan_type" class="form-control">
                                        <option name="loan_type" value="Murdharbaha">Murdharbaha</option>
                                        <option name="loan_type" value="Karz-e-Hasna">Karz-e-Hasna</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Loan Ac No</label>
                                    <input type="text" name="loan_no" class="form-control"
                                        value="{{ $member->loan_no }}">
                                </div>
                                @error('loan_no')
                                    <div class="alert-success"><strong>{{ $message }}</strong></span></div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Loan Snaction Date</label>
                                    <input type="date" name="loan_date" class="form-control"
                                        value="{{ $member->loan_date }}">
                                </div>
                                @error('loan_date')
                                    <div class="alert-success"><strong>{{ $message }}</strong></span></div>
                                @enderror
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Member A/c ID</label>
                                    <input type="text" name="member_id" class="form-control"
                                        value="{{ $member->member_id }}" disabled>
                                </div>
                            </div>

                            <div class="col-md-10">
                                <div class="form-group">
                                    <label>Reason For Loan </label>
                                    <input type="text" name="loan_reason" class="form-control"
                                        value="{{ $member->loan_reason }}">
                                </div>
                                @error('loan_reason')
                                    <div class="alert-success"><strong>{{ $message }}</strong></span></div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Enter Snaction Loan Amount </label>
                                    <input type="number" name="loan_amt" class="form-control"
                                        value="{{ $member->loan_amt }}">
                                </div>
                                @error('loan_amt')
                                    <div class="alert-success"><strong>{{ $message }}</strong></span></div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Enter Snaction Loan Profit Based on Contract </label>
                                    <input type="number" name="loan_profit" class="form-control"
                                        value="{{ $member->loan_profit }}">
                                </div>
                                @error('loan_profit')
                                    <div class="alert-success"><strong>{{ $message }}</strong></span></div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Enter Snaction Loan Duration on Contract </label>
                                    <input type="text" name="loan_duration" class="form-control"
                                        value="{{ $member->loan_duration }}">
                                </div>
                                @error('loan_duration')
                                    <div class="alert-success"><strong>{{ $message }}</strong></span></div>
                                @enderror
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Enter Snaction Loan Based on Contract Installment </label>
                                    <input type="text" name="loan_installment" class="form-control"
                                        value="{{ $member->loan_installment }}">
                                </div>
                                @error('loan_installment')
                                    <div class="alert-success"><strong>{{ $message }}</strong></span></div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Gurantator Name -1 </label>
                                    <input type="text" name="loan_gar_1" class="form-control"
                                        value="{{ $member->loan_g_1 }}">
                                </div>
                                @error('loan_gar_1')
                                    <div class="alert-success"><strong>{{ $message }}</strong></span></div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Gurantator Name -2 </label>
                                    <input type="text" name="loan_gar_2" class="form-control"
                                        value="{{ $member->loan_g_2 }}">
                                </div>
                                @error('loan_gar_2')
                                    <div class="alert-success"><strong>{{ $message }}</strong></span></div>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <button type="submit" class="btn btn-sm btn-primary float-right">Edit</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
@endsection
