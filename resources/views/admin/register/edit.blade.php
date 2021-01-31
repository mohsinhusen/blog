@extends('layouts.master')
@section('title')
    Edit Member Information|| Admin
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
                        <i class="now-ui-icons users_single-02"> </i> || </i> Edit Member Information
                    </h5>
                </div>

                <div class="card-body">
                    <form action="{{ url('member-cat-edit/' . $member->id) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ $member->name }}">
                                </div>
                                @error('name')
                                    <div class="alert-success"><strong>{{ $message }}</strong></span></div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Address</label>
                                    <select name="address" class="form-control" id="address" value="{{ $member->address }}">
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
                                    <input type="number" name="mobile" class="form-control" value="{{ $member->mobile }}">
                                </div>
                                @error('mobile')
                                    <div class="alert-success"><strong>{{ $message }}</strong></span></div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" value="{{ $member->email }}">
                                </div>
                                @error('email')
                                    <div class="alert-success"><strong>{{ $message }}</strong></span></div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control">
                                </div>
                                @error('password')
                                    <div class="alert-success"><strong>{{ $message }}</strong></span></div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Purchase Share</label>
                                    <input type="number" name="purchase_share" class="form-control"
                                        value="{{ $member->pur_share }}">
                                </div>
                                @error('purchase_share')
                                    <div class="alert-success"><strong>{{ $message }}</strong></span></div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0">InActive</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-12">
                            <button type="submit" class="btn btn-sm btn-primary float-right">
                                <i class="fas fa-edit" aria-hidden="true"></i> Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    @endsection

    @section('scripts')
    @endsection
