@extends('layouts.master')
@section('title')
    Edit Help Emergency || Admin
@endsection
@section('content')
    <div class="container">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Help Emergency
                        <a href="{{ url('expense-view') }}" class="btn btn-sm btn-success float-right py-2">Back</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ url('edit-help/' . $help->id) }}" method="POST" role="search">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" value="{{ $help->help_name }}" name=" help_name" class="form-control"
                                        placeholder="Enter Name" required>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Amount</label>
                                    <input type="number" value="{{ $help->help_amount }}" name=" help_amount"
                                        class="form-control" required placeholder="Enter Amount">
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control"
                                        name="help_description">{{ $help->help_description }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Date</label>
                                    <input type="date" value="{{ $help->help_date }}" name="help_date" class="form-control"
                                        required placeholder="Enter Date">
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control">
                                        <option value="0">Paid</option>
                                        <option value="1">Unpaid</option>
                                    </select>
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
