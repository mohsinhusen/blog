@extends('layouts.master')
@section('title')
    Edit Investment Record
@endsection
@section('content')
    <div class="container">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{ url('new-member') }}">
                        <button type="button" class="btn btn-sm btn-primary">
                            <i class="now-ui-icons arrows-1_minimal-left"> </i> </button></a>
                    <h5 class="card-title float-right">
                        <i class="now-ui-icons ui-2_settings-90"> || </i> {{ 'Edit Investment' }}
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ url('edit-investment/' . $investment->id) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Share Holder A/C Number</label>
                                    <input type="number" name="member_id" value="{{ $investment->id }}" class="form-control"
                                        readonly>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Purchase Share Monthly</label>
                                    <input type="number" name="p_share" value="{{ $investment->p_share }}"
                                        class="form-control" readonly>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Amount</label>
                                    <input type="number" name="amount" value="{{ $investment->amount }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Remarks</label>
                                    <select name="status" class="form-control">
                                        <option value="Regular">Regular</option>
                                        <option value="Advance">Advance</option>
                                        <option value="Late">Late</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Date</label>
                                    <input type="date" value="{{ $investment->date }}" name="inv_date" class="form-control"
                                        required>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <button type="submit" class="btn btn-sm btn-primary float-right">
                                    <i class="fa fa-edit" aria-hidden="true"></i> Update </button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
