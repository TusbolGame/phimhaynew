@extends('admin.master')
@section('header')
<div class="col-lg-12">
    <h1 class="page-header">Visits
        <small>List</small>
    </h1>
</div>
@endsection
@section('content')
<div class="col-lg-12 admin-detail">
    <table class="admin-table table table-striped table-bordered table-hover">
        <thead>
            <tr align="center">
                <th>ID</th>
                <th>IP Address</th>
                <th>Country</th>
                <th>City</th>
                <th>User</th>
                <th>Platform</th>
                <th>Browser</th>
                <th>Version</th>
                <th>Referer Host</th>
                <th>Page Views</th>
                <th>DateTime</th>
            </tr>
        </thead>
        <tbody>
             @foreach($visits as $data)
                <tr>
                    <td>{{ $data->id }}</td>
                    <td>{{ $data->ip }}</td>
                    <td>{{ $data->country }}</td>                    
                    <td>{{ $data->city }}</td>                    
                    <td>{{ $data->user_id }}</td>                    
                    <td>{{ $data->platform }}</td>                    
                    <td>{{ $data->browser_name }}</td>                    
                    <td>{{ $data->version }}</td>                    
                    <td>{{ $data->referer_host }}</td>                    
                    <td>{{ $data->page_views }}</td>                    
                    <td title="{!! $data->created_at !!}">{{ $data->created_at  }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {!! $visits->render() !!}
</div>
@endsection
