@extends('admin.master')
@section('header')
<div class="col-lg-12">
    <h1 class="page-header bg-primary">Type
        <small>Edit</small>
    </h1>
</div>
@endsection
@section('content')
<div class="col-lg-12" style="padding-bottom:120px">
    <form action="{{ route('admin.type.update', $film_type->id) }}" method="POST" class="form-add-film">
        @include('admin.messages.messages')
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="id" value="{!! $film_type->id !!}">
        <div class="col-lg-8">
            <div class="form-group">
              <label>Tên thể loại</label>
              <input type="text" class="form-control" name="type_name" placeholder="Nhập tên thể loại" required="true" value="{!! old('type_name', $film_type->type_name) !!}" autocomplete="off">
            </div>
            <div class="text-center">
                <input type="submit" name="submit" class="btn btn-primary" value="Cập nhât Type">
                <button type="reset" class="btn btn-default">Reset</button>
            </div>
        </div>
        
    <form>
</div>
@endsection
