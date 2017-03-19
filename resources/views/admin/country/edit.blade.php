@extends('admin.master')
@section('header')
<div class="col-lg-12">
    <h1 class="page-header bg-primary">Country
        <small class="text-danger">Edit</small>
    </h1>
</div>
@endsection
@section('content')
<div class="col-lg-12" style="padding-bottom:120px">
    <form action="{{ route('admin.country.update', $film_country->id) }}" method="POST" class="form-add-film">
        @include('admin.messages.messages')
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="id" value="{!! $film_country->id !!}">
        <div class="col-lg-8">
            <div class="form-group">
              <label>Tên quốc gia</label>
              <input type="text" class="form-control" name="country_name" placeholder="Nhập tên quốc gia" required="true" value="{!! old('country_name', $film_country->country_name) !!}" autocomplete="off">
            </div>
            <div class="text-center">
                <input type="submit" name="submit" class="btn btn-primary" value="Sửa quốc gia">
                <button type="reset" class="btn btn-default">Reset</button>
            </div>
        </div>
        
    <form>
</div>
@endsection
