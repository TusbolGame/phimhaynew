@extends('admin.master')
@section('header')
<div class="col-lg-12">
    <h1 class="page-header">User
        <small>List</small>
    </h1>
</div>
@endsection
@section('content')
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
    <thead>
        <tr align="center">
            <th>ID</th>
            <th>Username</th>
            <th>Level</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Actived</th>
            <th>Blocked</th>
            <th>Created_at</th>
            <th>Updated_at</th>
            <th>Delete</th>
            <th>Edit</th>
        </tr>
    </thead>
    <tbody>
         @foreach($data as $user)
            <tr class="odd gradeX" align="center">
                <td>{{ $user['id'] }}</td>
                <td>{{ $user['username'] }}</td>
                <!-- level -->
                <td>
                    @if($user['id'] == 1)
                        Supperadmin
                    @elseif($user['level'] == 1)
                        Admin
                    @elseif($user['level'] == 2)
                        Member
                    @endif
                </td>
                <td>{{ $user['first_name'] }}</td>
                <td>{{ $user['last_name'] }}</td>
                <td>{{ $user['email'] }}</td>
                <td>{{ $user['actived'] }}</td>
                <td>{{ $user['blocked'] }}</td>
                <td title="{!! $user['created_at'] !!}">{{ \Carbon\Carbon::createFromTimestamp(strtotime($user['created_at']))->diffForHumans()  }}</td>
                <td title="{!! $user['updated_at'] !!}">{{ \Carbon\Carbon::createFromTimestamp(strtotime($user['updated_at']))->diffForHumans()  }}</td>
                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a onclick="return checkDelete('Bạn có muốn xóa User id là {!! $user['id'] !!} không');" href="{!! route('admin.user.getDelete', $user['id']) !!}"> Delete</a></td>
                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{!! route('admin.user.getEdit', $user['id']) !!}">Edit</a></td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
