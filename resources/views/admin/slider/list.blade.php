@extends('admin.master')
@section('header')
<div class="col-lg-12">
    <h1 class="page-header">Slider
        <small class="text-danger">List</small>
    </h1>
</div>
@endsection
@section('content')
<table class="admin-table table table-striped table-bordered table-hover" id="dataTables-example">
    <thead>
        <tr align="center">
            <th>ID</th>
            <th>Silder Name</th>
            <th>Slider Dir</th>
            <th>Slider Image</th>
            <th>Created_at</th>
            <th>Updated_at</th>
            <th>Xóa</th>
            <th>Chỉnh Sửa</th>
        </tr>
    </thead>
    <tbody>
         @foreach($film_sliders as $data)
            <tr class="odd gradeX" align="center">
                <td>{{ $data->id }}</td>
                <td>{{ $data->slider_name }}</td>
                <td>{{ $data->slider_dir }}</td>
                <td>{{ $data->slider_image }}</td>
                <td title="{!! $data->created_at !!}">{{ $data->created_at  }}</td>
                <td title="{!! $data->updated_at !!}">{{ $data->updated_at  }}</td>
                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a onclick="return checkDelete('Bạn có muốn xóa Slider id là {!! $data->id !!} không');" href="{!! route('admin.slider.getDelete', $data->id) !!}"> Xóa</a></td>
                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{!! route('admin.slider.getEdit', $data->id) !!}">Sửa</a></td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
