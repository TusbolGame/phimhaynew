@extends('admin.master')
@section('header')
<div class="col-lg-12">
    <h1 class="page-header bg-primary">Type
        <small>Add</small>
    </h1>
</div>
@endsection
@section('content')
<div class="col-lg-12" style="padding-bottom:120px">
    <form action="{{ route('admin.type.store') }}" method="POST" class="form-add-person">
        @include('admin.messages.messages')
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">

        <div class="col-lg-8">
            <div class="form-group">
              <label>Tên thể loại</label>
              <input type="text" class="form-control" name="type_name" placeholder="Nhập tên thể loại" required="true" value="{!! old('type_name') !!}" autocomplete="off">
            </div>
            <div class="text-center">
                <input type="submit" name="submit" class="btn btn-primary" value="Thêm Type">
                <button type="reset" class="btn btn-default">Reset</button>
            </div>
        </div>
        
    <form>
</div>
@endsection
