@extends('admin.master')
@section('header')
<div class="col-lg-12">
    <h1 class="page-header">Slider
        <small class="text-danger">List</small>
    </h1>
</div>
@endsection
@section('content')
<table class="admin-table table table-striped table-bordered table-hover">
    <thead>
        <tr align="center">
            <th>Film ID</th>
            <th>Tên Vi</th>
            <th>Tên En</th>
            <th>Slider Image</th>
            <th>Xóa</th>
            <th>Chỉnh Sửa</th>
        </tr>
    </thead>
    <tbody>
         @foreach($film_sliders as $data)
            <tr class="odd gradeX" align="center">
                <td>{!! $data->film_id !!}</td>
                <td>{!! $data->filmList->film_name_vn !!}</td>
                <td>{!! $data->filmList->film_name_en !!}</td>
                <td><img src="{!! $data->filmDetail->getFilmPosterVideo() !!}" alt="Slider Image Error" width="125px" height="75px"></td>
                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a onclick="return checkDelete('Bạn có muốn xóa Slider id là {!! $data->id !!} không');" href="{!! route('admin.slider.getDelete', $data->id) !!}"> Xóa</a></td>
                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{!! route('admin.slider.getEdit', $data->id) !!}">Sửa</a></td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
