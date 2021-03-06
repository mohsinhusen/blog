@extends('layouts.master')
@section('title')
    Edit Sub-Admin Or User || Admin
@endsection
@section('content')
    <div class="container">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Sub-Admin Or User </h4>
                </div>
                <div class="card-body">
                    <form action="{{ url('Update-Role/' . $user->id) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" value="{{ $user->name }}" name="username" class="form-control"
                                        required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Mobile</label>
                                    <input type="number" value="{{ $user->phone }}" name="mobile" class="form-control"
                                        required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>User Type</label>
                                    <select name="typeuser" class="form-control">
                                        <option value="admin">Select Type of User</option>
                                        <option value="admin">Admin</option>
                                        <option value="subadmin">SubAdmin</option>
                                        <option value="other">otehr</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" value="{{ $user->email }}" name="email" class="form-control"
                                        required>

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control" required>

                                </div>
                            </div>

                            <div class="col-md-12">
                                <button type="submit" class="btn btn-info">Update</button>
                            </div>
                    </form>


                </div>

            </div>
        </div>
    </div>

@endsection

@section('scripts')
@endsection
