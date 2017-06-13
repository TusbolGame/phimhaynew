@extends('admin.master')
@section('header')
<div class="col-lg-12">
    <h1 class="page-header">Person
        <small class="text-danger">List</small>
    </h1>
</div>
@endsection
@section('content')
<div class="col-lg-12 admin-detail">
    <table class="admin-table table table-striped table-bordered table-hover">
        <thead>
            <tr align="center">
                <th>ID</th>
                <th>Chỉnh Sửa</th>
                <th>Xóa</th>
                <th>Image</th>
                <th>Tên nhân vật</th>
                <th>Created_at</th>
                <th>Updated_at</th>
            </tr>
        </thead>
        <tbody>
             @foreach($film_person as $data)
                <tr title="Person ID: {{ $data->id }}">
                    <td>{{ $data->id }}</td>
                    <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{!! route('admin.person.getEdit', $data->id) !!}">Sửa</a></td>
                    <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a onclick="return checkDelete('Bạn có muốn xóa Person id là {!! $data->id !!} không');" href="{!! route('admin.person.getDelete', $data->id) !!}"> Xóa</a></td> 
                    <td><img src="{{ $data->getPersonImage() }}" class="img-responsive" alt=""></td>
                    <td>{{ $data->person_name }}</td>
                    <td title="{!! $data->created_at !!}">{!! \Carbon\Carbon::createFromTimestamp(strtotime($data->created_at))->diffForHumans() !!}</td>
                    <td title="{!! $data->updated_at !!}">{!! \Carbon\Carbon::createFromTimestamp(strtotime($data->updated_at))->diffForHumans() !!}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<?php echo $film_person->render(); ?>
@endsection
