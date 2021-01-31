@extends('user.Layout.master')
@section('title')
    Create New Member || Admin
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="modal-dialog modal-confirm">
                        <div class="modal-content">
                            <div class="modal-body">
                                <p class="text-center">Your Loan has been Submit Sucessfully.
                                </p>
                            </div>
                            <div class="modal-footer">
                                <a href='{{ url('member-dashboard') }}'
                                    class="btn btn-success btn-block btn-sm float-right py-2">
                                    Dashboard</a>

                            </div>
                        </div>
                    </div>


                @endsection

                @section('scripts')
                @endsection
