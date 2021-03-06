@extends('admin.master')
@section('header')
<div class="col-lg-12">
    <h1 class="page-header bg-primary">Person
        <small  class="text-danger">Add</small>
    </h1>
</div>
@endsection
@section('content')
<div class="col-lg-12" style="padding-bottom:120px">
    <form action="{{ route('admin.person.getAdd') }}" method="POST" class="form-add-person" enctype="multipart/form-data">
        @include('admin.messages.messages')
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">

        <div class="col-lg-8">
            <div class="form-group">
              <label>Tên nhân vật</label>
              <input type="text" class="form-control" name="person_name" placeholder="Nhập tên nhân vật" required="true" value="{!! old('person_name') !!}" autocomplete="off">
            </div>
            <div class="form-group">
              <label>Tên nhân vật (đầy đủ)</label>
              <input type="text" class="form-control" name="person_full_name" placeholder="Nhập tên nhân vật (đầy đủ)" value="{!! old('person_full_name') !!}" autocomplete="off">
            </div>
            <div class="form-group">
              <label>Tên khai sinh</label>
              <input type="text" class="form-control" name="person_birth_name" placeholder="Nhập tên khai sinh" value="{!! old('person_birth_name') !!}" autocomplete="off">
            </div>
            <div class="form-group">
              <label>Tên biệt hiệu</label>
              <input type="text" class="form-control" name="person_nick_name" placeholder="Nhập tên biệt hiệu" value="{!! old('person_nick_name') !!}" autocomplete="off">
            </div>
            <div class="form-group">
              <label>Ngày sinh, địa điểm</label>
              <textarea class="form-control" name="person_birth_date" class="Nhập ngày sinh, địa điểm">{!! old('person_birth_date') !!}</textarea>
            </div>
            <div class="form-group">
             <label>Nghề nghiệp:</label>
                @foreach ($film_job as $job)
                <div class="checkbox">
                    <label><input type="checkbox" name="person_job[]" value="{!! $job->id !!}">{!! $job->job_name !!}</label>
                </div>
                @endforeach
            </div>
            <div class="form-group">
              <label>Chiều cao</label>
              <input type="text" class="form-control" name="person_height" placeholder="Nhập chiều cao" value="{!! old('person_height') !!}" autocomplete="off">
            </div>
            <div class="form-group">
              <label>Thông tin</label>
              <textarea class="form-control" name="person_info" placeholder="Nhập thông tin">{!! old('person_info') !!}</textarea>
            </div>
            <div class="form-group">
              <label>Ảnh đại diện</label>
              <div class="form-group">
                <label>Chọn file:</label>
                <input type="file" accept="image/*" name="person_image_file">
              </div>
              <div class="form-group">
                <label>Hoặc Nhập URL image</label>
                <textarea class="form-control" name="person_image_url" placeholder="Nhập đường dẫn ảnh">{!! old('person_image_url') !!}</textarea>
              </div>              
            </div>
            <div class="text-center">
                <input type="submit" name="submit" class="btn btn-primary" value="Thêm nhân vật">
                <button type="reset" class="btn btn-default">Reset</button>
            </div>
        </div>
        
    <form>
</div>
@endsection
