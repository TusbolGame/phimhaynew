@extends('admin.master')
@section('header')
<div class="col-lg-12">
    <h1 class="page-header">Type
        <small>List</small>
    </h1>
</div>
@endsection
@section('content')
<div class="col-lg-12 admin-detail">
    <table class="admin-table table table-striped table-bordered table-hover">
        <thead>
            <tr align="center">
                <th class="sorting_desc">ID</th>
                <th>Tên Thể loại</th>
                <th>Tên Alias</th>               
                <th>Created_at</th>
                <th>Updated_at</th>
                <th>Delete</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
             @foreach($film_type as $data)
                <tr class="odd gradeX" align="center" title="Person ID: {{ $data->id }}">
                    <td>{{ $data->id }}</td>
                    <td>{{ $data->type_name }}</td>
                    <td>{{ $data->type_alias }}</td>                    
                    <td title="{!! $data->created_at !!}">{{ $data->created_at  }}</td>
                    <td title="{!! $data->updated_at !!}">{{ $data->updated_at  }}</td>
                    <td class="center"><i class="fa fa-trash-o  fa-fw"></i>
                        <form action="{!! route('admin.type.destroy', $data->id) !!}" method="POST" accept-charset="utf-8">
                            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="id" value="{!! $data->id !!}">
                            <button type="submit" onclick="return checkDelete('Bạn có muốn xóa Type name là {!! $data->type_name !!} không');">Xóa</button>
                        </form>
                    </td>
                    <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{!! route('admin.type.edit', $data->id) !!}">Edit</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection