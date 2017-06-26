@extends('admin.master')
@section('header')
<div class="col-lg-12">
    <h1 class="page-header">User
        <small class="text-danger">List</small>
    </h1>
</div>
@endsection
@section('content')
<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr align="center">
            <th>ID</th>
            <th>Tên tài khoản</th>
            <th>Role</th>
            <th>Tên</th>
            <th>Họ</th>
            <th>Email</th>
            <th>Account</th>
            <th>Kích hoạt</th>
            <th>Chặn</th>
            <th>Created_at</th>
            <th>Updated_at</th>
            <th>Xóa</th>
            <th>Chỉnh sửa</th>
        </tr>
    </thead>
    <tbody>
         @foreach($users as $data)
            <tr class="odd gradeX" align="center">
                <td>{!! $data->id !!}</td>
                <td>{!! $data->username !!}</td>
                <!-- role -->
                <td>
                   @if(count($data->userRole) == 1) {!! $data->userRole->role->role_name !!} @endif
                </td>
                <td>{!! $data->first_name !!}</td>
                <td>{!! $data->last_name !!}</td>
                <td>
                    <?php 
                        //hash email
                        if (!empty($data->email)) {
                            $temp = explode('@', $data->email);
                            if(count($temp) == 2){
                                $name_hash_star = str_repeat('*', strlen($temp[0])-2);
                                echo substr($temp[0], 0, 2).$name_hash_star.'@'.$temp[1];
                            }
                        }
                     ?>
                </td>
                <td>
                    @if(count($data->socialAccount) == 0)
                        local
                    @else
                        {!! $data->socialAccount->provider !!}
                    @endif
                </td>
                <td>{!! $data->actived !!}</td>
                <td>{!! $data->blocked !!}</td>
                <td title="{!! $data->created_at !!}">{!! \Carbon\Carbon::createFromTimestamp(strtotime($data->created_at))->diffForHumans()  !!}</td>
                <td title="{!! $data->updated_at !!}">{!! \Carbon\Carbon::createFromTimestamp(strtotime($data->updated_at))->diffForHumans()  !!}</td>
                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a onclick="return checkDelete('Bạn có muốn xóa User id là {!! $data->id !!} không');" href="{!! route('admin.user.getDelete', $data->id) !!}">Xóa</a></td>
                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{!! route('admin.user.getEdit', $data->id) !!}">Sửa</a></td>
            </tr>
        @endforeach
    </tbody>
</table>
{!! $users->render() !!}
@endsection
