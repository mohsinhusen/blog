@extends('layouts.master')
@section('title')
    Create New Member || Admin
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{ url('new-member') }}">
                        <button type="button" class="btn btn-sm btn-primary">
                            <i class="now-ui-icons arrows-1_minimal-left"> </i> </button></a>

                    <h5 class="card-title float-right">
                        <i class="fa fa-user" aria-hidden="true"> || </i> Add Member
                    </h5>
                </div>

                @if (session('status'))
                    <div class="success">{{ session('status') }}</div>
                @endif

                <div class="card-body">
                    <form action="{{ url('member-store') }}" method="POST">
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Enter Full Member Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                                </div>
                                @error('name')
                                    <div class="alert-success"><strong>{{ $message }}</strong></span></div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Address</label>
                                    <select name="address" class="form-control" id="address">
                                        <option value="" disabled selected>--Select--</option>
                                        <option value="sadikpur">Sadikpur</option>
                                    </select>
                                </div>
                                @error('address')
                                    <div class="alert-success"><strong>{{ $message }}</strong></span></div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Member Type</label>
                                    <select name="membertype" class="form-control" id="membertype">
                                        <option value="" disabled selected>--Select--</option>
                                        <option value="member">Member</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                                @error('membertype')
                                    <div class="alert-success"><strong>{{ $message }}</strong></span></div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Mobile</label>
                                    <input type="number" name="mobile" class="form-control" value="{{ old('mobile') }}">
                                </div>
                                @error('mobile')
                                    <div class="alert-success"><strong>{{ $message }}</strong></span></div>
                                @enderror
                            </div>

                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Email for Member Login Dashboard</label>
                                    <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                                </div>
                                @error('email')
                                    <div class="alert-success"><strong>{{ $message }}</strong></span></div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Password for Member Login Dashboard</label>
                                    <input type="password" name="password" class="form-control"
                                        value="{{ old('password') }}">
                                </div>
                                @error('password')
                                    <div class="alert-success"><strong>{{ $message }}</strong></span></div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Purchased Monthly Share</label>
                                    <input type="number" name="pur_share" class="form-control" value="{{ old('pushare') }}">
                                </div>
                                @error('pur_share')
                                    <div class="alert-success"><strong>{{ $message }}</strong></span></div>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <button type="submit" class="btn btn-sm btn-primary float-right">
                                    <i class="fas fa-save" aria-hidden="true"> </i> Save </button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection

@section('scripts')


@endsection
