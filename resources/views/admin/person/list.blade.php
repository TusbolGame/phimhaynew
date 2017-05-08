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
                <th>Tên nhân vật</th>
                <th>Tên đầy đủ</th>
                <th>Tên khai sinh</th>
                <th>Biệt hiệu</th>
                <th>Ngày sinh</th>
                <th>Nghề nghiệp</th>
                <th>Chiều cao (m)</th>
                <th>Thông tin</th>
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
                    <td>{{ $data->person_name }}</td>
                    <td>{{ $data->person_full_name }}</td>
                    <td>{{ $data->person_birth_name }}</td>
                    <td>{{ $data->person_nick_name }}</td>
                    <td class="person_info">{{ $data->person_birth_date }}</td>
                    <td>
                        @if(count($data->filmPersonJob) > 0)
                        <ul>
                            @foreach ($data->filmPersonJob as $person_job)
                            <li>{!! $person_job->filmJob->job_name !!}</li>
                            @endforeach
                        </ul>
                        @endif
                    </td>
                    <td class="person_info">{{ $data->person_height }}</td>
                    <td class="person_info">{{ $data->person_info }}</td>
                    <td title="{!! $data->created_at !!}">{{ $data->created_at  }}</td>
                    <td title="{!! $data->updated_at !!}">{{ $data->updated_at  }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <?php echo $film_person->render(); ?>
</div>
@endsection
