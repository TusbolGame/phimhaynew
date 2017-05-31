@extends('admin.master')
@section('header')
<div class="col-lg-12">
    <h2 class="page-header">{!! $film_process->getFilmNameVnEn($film_list->film_name_vn, $film_list->film_name_en) !!}</h2>
</div>
@endsection
@section('content')
<div>
    <a href="{!! route('admin.film.getShow', $film_id) !!}" class="btn btn-primary">Thông tin phim</a>
    <a href="{!! route('admin.film.episode.getList', $film_id) !!}" class="btn btn-info">Danh sách Episode</a>
    <a href="{!! route('admin.film.episode.source.getAdd', $film_id) !!}" class="btn btn-success">Thêm Source</a>
</div>
<div class="div-overflow">         
    <table class="table table-bordered table-striped">
        <caption class="text-danger"><strong>Danh sách Source <span class="badge">{!! $film_sources->count() !!}</span></strong></caption>
        <thead>
            <tr>
                <th>Sửa</th>
                <th>Xóa</th>
                <th>ID</th>               
                <th>Language</th>
                <th>Track</th>
                <th>Source Full Status</th>
                <th>Source Name</th>
                <th>Source Full</th>
                <th>Source 360p</th>
                <th>Source 480p</th>
                <th>Source 720p</th>
                <th>Source 1080p</th>
                <th>Source 2160p</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($film_sources as $data)
            <tr>
                <td><a href="{!! route('admin.film.episode.source.getEdit', [$film_id, $data->film_episode_id, $data->id]) !!}">Sửa ID {!! $data->id !!}</a></td>
                <td><a onclick="return checkDelete('Bạn có muốn xóa Episode_id là {!! $data->id !!} không?');" href="{!! route('admin.film.episode.source.getDelete', [$film_id, $data->film_episode_id, $data->id]) !!}"> Xóa ID {!! $data->id !!}</a></td>
                <td>{!! $data->id !!}</td> 
                <td>{!! $data->film_episode_language !!}</td>
                <td>@if(count($data->filmSourceTrack) == 1) Yes @else No @endif</td>
                <?php $http_response_code->setUrl($data->film_src_full);  ?>
                <td {{-- @if($http_response_code->checkHttpResponseCode200()) class="bg-success" @else class="bg-danger"@endif --}}>{{-- {!! $http_response_code->getStatusCode() !!} --}}</td>
                <td>{!! $data->film_src_name !!}</td>                
                <td>{!! $data->film_src_full !!}</td>
                <td>{!! $data->film_src_360p !!}</td>
                <td>{!! $data->film_src_480p !!}</td>
                <td>{!! $data->film_src_720p !!}</td>
                <td>{!! $data->film_src_1080p !!}</td>
                <td>{!! $data->film_src_2160p !!}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {!! $film_sources->render() !!}
</div>
@endsection
