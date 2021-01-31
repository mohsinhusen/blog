@extends('layouts.master')

@section('title')
About Us || Edit Data | Admin
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">      
                <h4 class="card-title"> About Us || Edit Data</h4>
            <form action="{{ url('aboutus-update/'.$aboutus->id) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('PUT')   }}
                        <div class="modal-body">
                        <div class="form-group">
                            <label for="title" class="col-form-label">Title:</label>
                            <input type="text" name="title" class="form-control" value={{ $aboutus->title }}>
                        </div>
                        <div class="form-group">
                            <label for="title" class="col-form-label">Title:</label>
                            <input type="text" name="subtitle" class="form-control" value={{ $aboutus->subtitle }}>
                        </div>
                        <div class="form-group">
                            <label for="description" class="col-form-label">Description:</label>
                            <textarea class="form-control" name="descri">{{ $aboutus->description }}</textarea>
                        </div>
                    <div class="modal-footer">
                        <a href="{{ url('abouts') }}" class="btn btn-secondary">Back</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection


@section('scripts')
@endsection

