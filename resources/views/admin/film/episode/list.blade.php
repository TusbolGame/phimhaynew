@extends('admin.master')
@section('header')
<div class="col-lg-12">
    <h2 class="page-header">{!! $film_process->getFilmNameVnEn($film_list->film_name_vn, $film_list->film_name_en) !!}</h2>
</div>
@endsection
@section('content')
<div>
    <a href="{!! route('admin.film.getShow', $film_id) !!}" class="btn btn-info">Quay lại</a>
    <a href="{!! route('admin.film.episode.getAddWithSource', $film_id) !!}" class="btn btn-success">Thêm Nhanh Episode - Source</a>
    <a href="{!! route('admin.film.episode.getGrabLink', $film_id) !!}" class="btn btn-primary">Grab Link Video</a>
    <a href="{!! route('admin.film.episode.getAdd', $film_id) !!}" class="btn btn-success">Thêm Episode</a>
</div>
<div class="div-overflow">         
    <table class="table table-bordered table-striped">
        <caption class="text-danger"><strong>Danh sách tập <span class="badge">{!! $film_episodes->total() !!}</span></strong></caption>
        <thead>
            <tr>
                
                {{-- <th>ID</th>                --}}
                <th>Episode</th>               
                <th>Episode Name</th>
                <th>Total source</th>
                <th>Chi tiết</th>
                <th>Sửa</th>
                <th>Xóa</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($film_episodes as $film_episode)
            <tr>
                
                {{-- <td>{!! $film_episode->id !!}</td>  --}}
                <td>{!! $film_episode->film_episode !!}</td> 
                <td>{!! $film_episode->film_episode_name !!}</td>
                <td>{!! $film_episode->filmSource->count() !!}</td>
                <td><a href="{!! route('admin.film.episode.source.getList', [$film_id, $film_episode->id]) !!}" class="btn btn-info">Chi tiết episode {!! $film_episode->film_episode !!}</a></td>
                <td><a href="{!! route('admin.film.episode.getEdit', [$film_id, $film_episode->id]) !!}" class="btn btn-primary">Sửa Episode {!! $film_episode->film_episode !!}</a></td>
                <td><a onclick="return checkDelete('Bạn có muốn xóa Episode là {!! $film_episode->film_episode !!} không?');" href="{!! route('admin.film.episode.getDelete', [$film_id, $film_episode->id]) !!}" class="btn btn-danger"> Xóa Episode {!! $film_episode->film_episode !!}</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {!! $film_episodes->render() !!}
</div>
@endsection
