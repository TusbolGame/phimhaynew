@extends('admin.master')
@section('header')
<div class="col-lg-12">
    <h1 class="page-header">Product
        <small>Edit</small>
    </h1>
</div>
@endsection
@section('content')
<div class="col-lg-7" style="padding-bottom:120px">
    <form action="{!! route('admin.product.getEdit', $product['id']) !!}" method="POST" id="form-product-edit" enctype="multipart/form-data">
        @include('admin.messages.messages')
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <input type="hidden" name="product_id" value="{{ $product['id'] }}">
        <div class="form-group">
            <label>Category Parent</label>
            <select name="cate_id" class="form-control">
                <option value="">Please Choose Category</option>
                <?php 
                    cate_parent($cate, 0, '--', old('cate_id', isset($product) ? $product['cate_id'] : null));
                 ?>
            </select>
        </div>
        <div class="form-group">
            <label>Name</label>
            <input class="form-control" name="txtName" value="{!! old('txtName', isset($product) ? $product['name'] : null) !!}" placeholder="Please Enter Username" />
        </div>
        <div class="form-group">
            <label>Price</label>
            <input class="form-control" name="txtPrice" value="{!! old('txtPrice', isset($product) ? $product['price'] : null) !!}" placeholder="Please Enter Price" />
        </div>
        <div class="form-group">
            <label>Intro</label>
            <textarea class="form-control" rows="3" name="txtIntro">{!! old('txtIntro', isset($product) ? $product['intro'] : null) !!}</textarea>
            <script type="text/javascript">ckeditor('txtIntro')</script>

        </div>
        <div class="form-group">
            <label>Content</label>
            <textarea class="form-control" rows="3" name="txtContent">{!! old('txtContent', isset($product) ? $product['content'] : null) !!}</textarea>
            <script type="text/javascript">ckeditor('txtContent')</script>

        </div>
        <div class="form-group">
            @if(!empty($product['image']))
            <div class="row">
                <div class="col-sm-4">
                    <img class="img-responsive" src="{!! url('resources/upload/product/'.$product['image']) !!}" width="100%" height="auto" alt="error image product">
                    <span>{!! $product['image'] !!}</span>
                </div>
                <div class="col-sm-8">
                    <label style="color:#d9534f;">Chọn ảnh thay thế, sửa đổi</label>
                    <input type="file" name="fImages"  value="{!! old('fImages') !!}">
                </div>
            </div>
            @else
                <label>Chưa có Images</label>
                <input type="file" name="fImages"  value="{!! old('fImages') !!}">
            @endif
        </div>
        <div class="form-group">
            <label>Product Keywords</label>
            <input class="form-control" name="txtKeywords"  value="{!! old('txtKeywords', isset($product) ? $product['keywords'] : null) !!}" placeholder="Please Enter Category Keywords" />
        </div>
        <div class="form-group">
            <label>Product Description</label>
            <textarea class="form-control" rows="3" name="txtDescription">{!! old('txtDescription', isset($product) ? $product['description'] : null) !!}</textarea>
        </div>
        <div class="form-group">
            <!-- list product_detail -->
            @if(!empty($product_detail))
                <!-- show product_detail -->
                <label>Hình ảnh product details</label>
                <div class="form-group">
                    <ul class="list-detail">
                        @foreach($product_detail as $key)
                        <li>
                            <input type="hidden" name="img_id" value="{{ $key['id'] }}">
                            <img src="{!! url('resources/upload/detail/'.$key['image']) !!}" alt="Find not image">
                            <br>
                            <span class="image-name">{!! $key['image'] !!}</span>
                            <span class="glyphicon glyphicon-remove remove-detail" title="Xóa Image"></span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="select-product-detail">
                <label> Thêm Image Product Detail </label>
                <input type="file" name="fProductDetail[]" value="">
            </div>
            <a class="btn btn-link add-detail" href="javascript:void(0)" title="">Add image product detail</a>
        </div>
        <button type="submit" class="btn btn-default">Product Edit</button>
        <button type="reset" class="btn btn-default">Reset</button>
    <form>
</div>
@endsection
