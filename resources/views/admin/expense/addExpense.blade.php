@extends('layouts.master')
@section('title')
    Add Expense || Admin
@endsection
@section('content')
    <div class="container">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Add Expense
                        <a href="{{ url('expense-view') }}" class="btn btn-success float-right py-2">Back</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ url('role-addExpense') }}" method="POST" role="search">
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Expense Voucher No</label>
                                <input type="number" name="exp_id" value="{{ $id}}" class="form-control" disabled>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Expense Description</label>
                                    <input type="text" name="exp_descr" class="form-control" placeholder="Enter Expense Description" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Expense Amount</label>
                                    <input type="number" name="exp_amount" class="form-control" required placeholder="Enter Amount">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Expense Date</label>
                                    <input type="date" name="exp_date" class="form-control" required placeholder="Enter Mobile No">

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
@endsection
