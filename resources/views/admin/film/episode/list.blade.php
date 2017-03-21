@extends('admin.master')
@section('header')
<div class="col-lg-12">
    <h2 class="page-header">{!! $film_process->getFilmNameVnEn($film_list->film_name_vn, $film_list->film_name_en) !!}</h2>
</div>
@endsection
@section('content')
<div>
    <a href="{!! route('admin.film.getShow', $film_id) !!}" class="btn btn-info">Quay lại</a>
    <a href="{!! route('admin.film.episode.getAdd', $film_id) !!}" class="btn btn-success">Thêm Episode</a>
</div>
<div class="div-overflow">         
    <table class="table table-bordered table-striped">
        <caption class="text-danger"><strong>Danh sách source video <span class="badge">{!! $film_episodes->count() !!}</span></strong></caption>
        <thead>
            <tr>
                <th>Sửa</th>
                <th>Xóa</th>
                <th>ID</th>
                <th>Link Number</th>
                <th>Language</th>
                <th>Episode</th>
                <th>Track</th>
                <th>Source Name</th>
                <th>Source Full</th>
                <th>Source 360p</th>
                <th>Source 480p0p</th>
                <th>Source 720p</th>
                <th>Source 1080p</th>
                <th>Source 216p</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($film_episodes as $film_episode)
            <tr>
                <td><a href="{!! route('admin.film.episode.getEdit', [$film_id, $film_episode->id]) !!}">Sửa ID {!! $film_episode->id !!}</a></td>
                <td><a onclick="return checkDelete('Bạn có muốn xóa Episode_id là {!! $film_episode->id !!} không?');" href="{!! route('admin.film.episode.getDelete', [$film_id, $film_episode->id]) !!}"> Xóa ID {!! $film_episode->id !!}</a></td>
                <td>{!! $film_episode->id !!}</td>
                <td>{!! $film_episode->film_link_number !!}</td>
                <td>{!! $film_episode->film_episode_language !!}</td>
                <td>{!! $film_episode->film_episode !!}</td>
                <td>@if(count($film_episode->filmEpisodeTrack) == 1) Yes @else No @endif</td>
                <td>{!! $film_episode->film_src_name !!}</td>
                <td>{!! $film_episode->film_src_full !!}</td>
                <td>{!! $film_episode->film_src_360p !!}</td>
                <td>{!! $film_episode->film_src_480p !!}</td>
                <td>{!! $film_episode->film_src_720p !!}</td>
                <td>{!! $film_episode->film_src_1080p !!}</td>
                <td>{!! $film_episode->film_src_2160p !!}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {!! $film_episodes->render() !!}
</div>
@endsection
