@extends('layouts.master')
@section('title')
    Rojmel View Between Date || Admin
@endsection
@section('content')
    <!-- Reference -->
    <div class="container">
        <div class="col-md-12">
            <section id="reference" class="card">
                <div class="card-body center-block">
                    <form action="{{ url('/report') }}" method="POST" class="form-inline text-center">
                        {{ csrf_field() }}
                        <div class="input-group input-daterange">
                            <label for="email" class="mr-sm-2">First Date:</label>
                            <input type="date" name="start_date" id="from_date" class="form-control mb-2 mr-sm-2" required>
                            <label for="pwd" class="mr-sm-2">Last Date :</label>
                            <input type="date" name="end_date" id="to_date" class="form-control mb-2 mr-sm-2" required>
                            <input type="submit" name="filter" id="filter" class="btn btn-info btn-sm" value="Submit">

                    </form>
            </section>
        </div>
    </div>

@endsection

@section('scripts')
@endsection
