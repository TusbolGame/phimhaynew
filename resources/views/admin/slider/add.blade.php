@extends('admin.master')
@section('header')
<div class="col-lg-12">
    <h1 class="page-header bg-primary">Slider
        <small class="text-danger">Add</small>
    </h1>
</div>
@endsection
@section('content')
<div class="col-lg-12" style="padding-bottom:120px">
    <form action="{{ route('admin.slider.getAdd') }}" method="POST" class="form-add-film">
        @include('admin.messages.messages')
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">

        <div class="col-lg-8">
            <div class="form-group">
                <label>Silder Name</label>
                <textarea name="slider_name" class="form-control" placeholder="Nhập Slider name">{!! old('slider_name') !!}</textarea>
            </div>
            <div class="form-group">
                <label>Silder Dir (full)</label>
                <textarea name="slider_dir" class="form-control" placeholder="Nhập Slider dir">{!! old('slider_dir') !!}</textarea>
            </div>
            <div class="form-group">
                <label>Silder Image (url)</label>
                <textarea name="slider_image" class="form-control" placeholder="Nhập Slider image">{!! old('slider_image') !!}</textarea>
            </div>
            <div class="text-center">
                <input type="submit" name="submit" class="btn btn-primary" value="Thêm Silder">
                <button type="reset" class="btn btn-default">Reset</button>
            </div>
        </div>
        
    <form>
</div>
@endsection
