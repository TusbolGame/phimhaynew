@extends('admin.master')
@section('header')
<div class="col-lg-12">
    <h1 class="page-header">Product
        <small>List</small>
    </h1>
</div>
@endsection
@section('content')
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
    <thead>
        <tr align="center">
            <th>ID</th>
            <th>Name</th>
            <th>Price (VND)</th>
            <th>Category</th>
            <th>Date</th>
            <th>Delete</th>
            <th>Edit</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $product)
        <tr class="gradeX" align="center">
            <td>{!! $product['id'] !!}</td>
            <td>{!! $product['name'] !!}</td>
            <td class="text-right">{!! number_format($product['price'], 0, ',', '.')!!}</td>
            <td>
                <?php 
                    $cate = DB::table('cates')->where('id', $product['cate_id'])->first();
                    if(!empty($cate->name)){
                        echo $cate->name;
                    }
                ?>
            </td>
            <td>{!! \Carbon\Carbon::createFromTimestamp(strtotime($product['created_at']))->diffForHumans(); !!}</td>
            <!-- <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a onclick="checkDelete('Xoa')" href="javascript:void(0)"> Delete</a></td> -->
             <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a onclick="return checkDelete('Bạn có muốn xóa Product id {!! $product['id'] !!} này không')" href="{!! URL::route('admin.product.getDelete',$product['id']) !!}"> Delete</a></td>
            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{!! URL::route('admin.product.getEdit',$product['id']) !!}">Edit</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
