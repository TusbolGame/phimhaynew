@extends('admin.master')
@section('header')
<div class="col-lg-12">
    <h1 class="page-header">Job
        <small>List</small>
    </h1>
</div>
@endsection
@section('content')
<table class="admin-table table table-striped table-bordered table-hover" id="dataTables-example">
    <thead>
        <tr align="center">
            <th>ID</th>
            <th>Job Name</th>
            <th>Created_at</th>
            <th>Updated_at</th>
            <th>Delete</th>
            <th>Edit</th>
        </tr>
    </thead>
    <tbody>
         @foreach($film_jobs as $data)
            <tr class="odd gradeX" align="center">
                <td>{{ $data->id }}</td>
                <td>{{ $data->job_name }}</td>
                <td title="{!! $data->created_at !!}">{{ $data->created_at  }}</td>
                <td title="{!! $data->updated_at !!}">{{ $data->updated_at  }}</td>
                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a onclick="return checkDelete('Bạn có muốn xóa Job name là {!! $data->job_name !!} không');" href="{!! route('admin.job.getDelete', $data->id) !!}"> Delete</a></td>
                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{!! route('admin.job.getEdit', $data->id) !!}">Edit</a></td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
