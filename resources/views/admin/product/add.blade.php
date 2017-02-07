@extends('admin.master')
@section('header')
<div class="col-lg-12">
    <h1 class="page-header">Product
        <small>Add</small>
    </h1>
</div>
@endsection
@section('content')
<div class="col-lg-7" style="padding-bottom:120px">
    <form action="{!! url('admin/product/add')!!}" method="POST" enctype="multipart/form-data">
        @include('admin.messages.messages')
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <div class="form-group">
            <label>Category Parent</label>
            <select name="cate_id" class="form-control">
                <option value="">Please Choose Category</option>
                <?php 
                    cate_parent($cate, 0, '--', old('cate_id'));
                 ?>
            </select>
        </div>
        <div class="form-group">
            <label>Name</label>
            <input class="form-control" name="txtName" value="{!! old('txtName') !!}" placeholder="Please Enter Username" />
        </div>
        <div class="form-group">
            <label>Price</label>
            <input class="form-control" name="txtPrice" value="{!! old('txtPrice') !!}" placeholder="Please Enter Price" />
        </div>
        <div class="form-group">
            <label>Intro</label>
            <textarea class="form-control" rows="3" name="txtIntro" >{!! old('txtIntro') !!}</textarea>
            <script type="text/javascript">ckeditor('txtIntro')</script>
        </div>
        <div class="form-group">
            <label>Content</label>
            <textarea class="form-control" rows="3" name="txtContent">{!! old('txtContent') !!}</textarea>
            <script type="text/javascript">ckeditor('txtContent')</script>
        </div>
        <div class="form-group">
            <label>Images Product</label>
            <input type="file" name="fImages" value="{!! old('fImages') !!}">
        </div>
        <div class="form-group">
            <label>Product Keywords</label>
            <input class="form-control" name="txtKeywords"  value="{!! old('txtKeywords') !!}" placeholder="Please Enter Category Keywords" />
        </div>
        <div class="form-group">
            <label>Product Description</label>
            <textarea class="form-control" name="txtDescription" rows="3">{!! old('txtDescription') !!}</textarea>
        </div>
        <div class="form-group">
            <div class="select-product-detail">
                <label> Image Product Detail <span>1</span></label>
                <input type="file" name="fProductDetail[]" value="">
            </div>
            <a class="btn btn-link add-product-detail" href="javascript:void(0)" title="">Add image product detail</a>
        </div>
        <button type="submit" class="btn btn-default">Product Add</button>
        <button type="reset" class="btn btn-default">Reset</button>        
    <form>
</div>
@endsection

