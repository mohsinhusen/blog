@extends('layouts.master')
@section('title')On-Hand Amount Month Wise
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="text-wrap float-right" style="width:autorem;">
                        Month wise cash on hand
                    </h5>
                    <a href="{{ url('dashboard') }}">
                        <button type="button" class="btn btn-sm btn-primary float-left py-1"><i
                                class="fas fa-arrow-left fa-0x" aria-hidden="true"></i></button></a>



                    @if (session('status'))
                        <div class="alert alert-primary alert-with-icon" data-notify="container">
                            <button type="button" aria-hidden="true" class="close">
                                <i class="now-ui-icons emoticons_satisfied"></i>
                            </button>
                            <span data-notify="icon" class="now-ui-icons ui-1_bell-53"></span>
                            <span data-notify="message">{{ session('status') }}</span>
                        </div>
                    @elseif(session('error'))
                        <div class="alert alert-danger alert-with-icon" data-notify="container">
                            <button type="button" aria-hidden="true" class="close">
                                <i class="now-ui-icons ui-1_simple-remove"></i>
                            </button>
                            <span data-notify="icon" class="now-ui-icons ui-1_bell-53"></span>
                            <span data-notify="message">{{ session('error') }}</span>
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Date</th>
                                    <th>Inward</th>
                                    <th>Outward</th>
                                    <th>On Hand</th>
                                </tr>
                            </thead>
                            @foreach ($onhand as $key => $item)
                                <tr>
                                    <input type="hidden" class="serdelete_val_id" value="{{ $item->id }}">
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->date }}</td>
                                    <td>{{ $item->inward_amount }}</td>
                                    <td>{{ $item->outward_amount }}</td>
                                    <td>{{ $item->onhand_amount }}</td>
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
