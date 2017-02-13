@extends('admin.master')
@section('header')
<div class="col-lg-12">
    <h1 class="page-header bg-primary">Person
        <small>Edit</small>
    </h1>
</div>
@endsection
@section('content')
<div class="col-lg-12" style="padding-bottom:120px">
    <form action="{{ route('admin.person.getEdit', $person->id) }}" method="POST" class="form-add-film">
        @include('admin.messages.messages')
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">

        <div class="col-lg-8">
            <div class="form-group">
              <label>Tên nhân vật</label>
              <input type="text" class="form-control" name="person_name" placeholder="Nhập tên nhân vật" required="true" value="{!! old('person_name', $person->person_name) !!}">
            </div>
            <div class="form-group">
              <label>Tên nhân vật (đầy đủ)</label>
              <input type="text" class="form-control" name="person_full_name" placeholder="Nhập tên nhân vật (đầy đủ)" value="{!! old('person_full_name', $person->person_full_name) !!}">
            </div>
            <div class="form-group">
              <label>Tên khai sinh</label>
              <input type="text" class="form-control" name="person_birth_name" placeholder="Nhập tên khai sinh" value="{!! old('person_birth_name', $person->person_birth_name) !!}">
            </div>
            <div class="form-group">
              <label>Tên biệt hiệu</label>
              <input type="text" class="form-control" name="person_nick_name" placeholder="Nhập tên biệt hiệu" value="{!! old('person_nick_name', $person->person_nick_name) !!}">
            </div>
            <div class="form-group">
              <label>Ngày sinh, địa điểm</label>
              <textarea class="form-control" name="person_birth_date" class="Nhập ngày sinh, địa điểm">{!! old('person_birth_date', $person->person_birth_date) !!}</textarea>
            </div>
            <div class="form-group">
              <label>Giới tính:</label>
              <label>Nam<input type="radio" name="person_sex" value="Nam" required="true" @if(old('person_sex', $person->person_sex) == 'Nam') checked="true" @endif></label>
              <label>Nữ<input type="radio" name="person_sex" value="Nữ" required="true" @if(old('person_sex', $person->person_sex) == 'Nữ') checked="true" @endif></label>
              <br>
            </div>
            <div class="form-group">
             <label>Nghề nghiệp:</label>
              <select name="person_job[]" class="form-control" required="true" multiple>
              <?php 
                $check_job = [];
                    foreach ($film_person_job as $person_job) {
                        $check_job[$person_job->filmJob->id] = 1;
                    }
               ?>
                @foreach ($film_job as $job)
                    <option value="{!! $job->id !!}" @if(isset($check_job[$job->id])) selected @endif>{!! $job->job_name !!}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label>Chiều cao</label>
              <input type="text" class="form-control" name="person_height" placeholder="Nhập chiều cao" value="{!! old('person_height', $person->person_height) !!}">
            </div>
            <div class="form-group">
              <label>Thông tin</label>
              <textarea class="form-control" name="person_info" placeholder="Nhập thông tin">{!! old('person_info', $person->person_info) !!}</textarea>
            </div>
            <div class="form-group">
              <label>Ảnh đại diện</label>
              <textarea class="form-control" name="person_image" required="true" placeholder="Nhập đường dẫn ảnh">{!! old('person_image', $person->person_image) !!}</textarea>
            </div>
            <div class="text-center">
                <input type="submit" name="submit" class="btn btn-primary" value="Cập nhật Person">
                <button type="reset" class="btn btn-default">Reset</button>
            </div>
        </div>
        
    <form>
</div>
@endsection
