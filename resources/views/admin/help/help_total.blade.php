@extends('layouts.master')
@section('title')Total Help || Admin
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Total Help
                        <a href='{{ url('role-help_create') }}' class="btn btn-sm btn-success float-right py-2">Add</a>
                    </h4>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            @foreach ($total_help as $key => $item)

                                <tr>
                                    <input type="hidden" class="serdelete_val_id" value="{{ $item->id }}">
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->help_name }}</td>
                                    <td>{{ $item->help_amount }}</td>
                                    <td>{{ $item->help_date }}</td>



                                </tr>
                                </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('scripts')
@endsection
