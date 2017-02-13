@extends('admin.master')
@section('header')
<div class="col-lg-12">
    <h1 class="page-header bg-primary">Slider
        <small>Add</small>
    </h1>
</div>
@endsection
@section('content')
<div class="col-lg-12" style="padding-bottom:120px">
    <form action="{{ route('admin.job.getAdd') }}" method="POST" class="form-add-job">
        @include('admin.messages.messages')
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">

        <div class="col-lg-8">
            <div class="form-group">
                <label>Tên nghề nghiệp</label>
                <textarea name="job_name" class="form-control" placeholder="Nhập Job name">{!! old('job_name') !!}</textarea>
            </div>
            
            <div class="text-center">
                <input type="submit" name="submit" class="btn btn-primary" value="Thêm Job">
                <button type="reset" class="btn btn-default">Reset</button>
            </div>
        </div>
        
    <form>
</div>
@endsection
