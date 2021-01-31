@extends('layouts.master')
@section('title')
    Edit Expense || Admin
@endsection
@section('content')
    <div class="container">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Expense
                        <a href="{{ url('expense-view') }}" class="btn btn-success float-right py-2">Back</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ url('role-edit-expense/'.$expense->id) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Expense Description</label>
                                <input type="text" name="exp_descr" class="form-control" value="{{$expense->exp_description}}" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Expense Amount</label>
                                    <input type="number" name="exp_amount" class="form-control" required value="{{$expense->exp_amount}}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Expense Date</label>
                                    <input type="date" name="exp_date" class="form-control" required value="{{$expense->exp_date}}">

                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-info">Edit</button>
                            </div>
                    </form>


                </div>

            </div>
        </div>
    </div>

@endsection

@section('scripts')
@endsection
