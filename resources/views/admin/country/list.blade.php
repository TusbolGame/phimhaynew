@extends('admin.master')
@section('header')
<div class="col-lg-12">
    <h1 class="page-header">Country
        <small class="text-danger">List</small>
    </h1>
</div>
@endsection
@section('content')
<div class="col-lg-12 admin-detail">
    <table class="admin-table table table-striped table-bordered table-hover">
        <thead>
            <tr align="center">
                <th class="sorting_desc">ID</th>
                <th>Tên quốc gia</th>
                <th>Tên Alias</th>               
                <th>Xóa</th>
                <th>Chỉnh Sửa</th>
            </tr>
        </thead>
        <tbody>
             @foreach($film_country as $data)
                <tr class="odd gradeX" align="center" title="Person ID: {{ $data->id }}">
                    <td>{{ $data->id }}</td>
                    <td>{{ $data->country_name }}</td>
                    <td>{{ $data->country_alias }}</td>                    
                    <td class="center">
                        <form action="{!! route('admin.country.destroy', $data->id) !!}" method="POST" accept-charset="utf-8">
                            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="id" value="{!! $data->id !!}">
                            <button type="submit" onclick="return checkDelete('Bạn có muốn xóa Country name là {!! $data->country_name !!} không');">Xóa</button>
                        </form>
                    </td>
                    <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{!! route('admin.country.edit', $data->id) !!}">Sửa</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
