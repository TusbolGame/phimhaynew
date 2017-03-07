@extends('admin.master')
@section('header')
<div class="col-lg-12">
    <h1 class="page-header bg-primary">{!! $film_process->getFilmNameVnEn($film_list->film_name_vn, $film_list->film_name_en) !!}
        <small class="text-danger">Edit Episode</small>
    </h1>
</div>
@endsection
@section('content')
<div class="col-lg-12 admin-detail">
    <div>
        <a href="{!! route('admin.film.episode.getList', $film_id) !!}" class="btn btn-info">Quay lại Film Episode List</a>
    </div>
    <div class="col-lg-6">
        <form action="{!! route('admin.film.episode.postEdit', [$film_list->id, $film_episode->id]) !!}" method="post" accept-charset="utf-8" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            <div class="form-group">           
                <label>Episode</label><br>
                <label>Link Number: </label>
                <input type="number" name="film_link_number" class="form-control" value="{!! $film_episode->film_link_number !!}" placeholder="Nhập link number">
            </div>
            <div class="form-group">
                <label>Ngôn Ngữ Episode:</label>
                <div>
                    <select name="film_episode_language" class="form-control">
                        <option value="vs" @if($film_episode->film_episode_language == 'vs') selected @endif>VietSub</option>
                        <option value="tm" @if($film_episode->film_episode_language == 'tm') selected @endif>Thuyết Minh</option>
                        <option value="lt" @if($film_episode->film_episode_language == 'lt') selected @endif>Lồng Tiếng</option>
                        <option value="es" @if($film_episode->film_episode_language == 'es') selected @endif>EnlishSub</option>
                        <option value="raw" @if($film_episode->film_episode_language == 'raw') selected @endif>Raw</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label>Chất Lượng Episode:</label>
                <div>
                    <select name="film_episode_quality" class="form-control">
                        <option value="360p" @if($film_episode->film_episode_quality == '360p') selected @endif>360p</option>
                        <option value="480p" @if($film_episode->film_episode_quality == '480p') selected @endif>480p</option>
                        <option value="720p" @if($film_episode->film_episode_quality == '720p') selected @endif>720p</option>
                        <option value="1080p" @if($film_episode->film_episode_quality == '1080p') selected @endif>1080p</option>
                        <option value="2160p" @if($film_episode->film_episode_quality == '2160p') selected @endif>2160p</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label>Film Episode: lẻ - 0, bộ - tập mấy  </label>
                <input type="number" name="film_episode" class="form-control" value="{!! $film_episode->film_episode !!}" placeholder="Nhập: bộ là tập mấy, lẻ là 0">
            </div>
            @if(count($film_track) == 1)
                {{-- is track --}}
                <div class="form-group">
                    <label>Track (File Sub): </label>
                    <div class="form-group">
                        <label>Track Type: <em class="text-danger">.{!! $film_track->film_track_type !!}</em></label>
                    </div>
                    <div class="form-group">
                        <label>Track Source: <em class="text-danger">{!! $film_track->film_track_src !!}</em></label>
                        
                    </div>
                </div>
                <div class="form-group">
                    <label class="alert alert-danger"><input type="checkbox" class="delete-select-track" name="film_track_delete" value="1"> Xóa Track</label>
                </div>
                <div class="form-group">
                    <label class="alert alert-success"><input type="checkbox" class="show-select-track" name="film_track_edit" value="1"> Chỉnh sửa Track</label>
                </div>  
                <div class="form-group hidden track-edit">
                    <label>Track (File Sub): </label>
                    <div class="form-group">
                        <label>Track Type: </label>
                        <select class="form-control" name="film_track_type">
                            <option value="">Chọn track type</option>
                            <option value="vtt" @if(old('film_track_type') == 'vtt') selected @endif>.VTT</option>
                            <option value="ass" @if(old('film_track_type') == 'ass') selected @endif>.ASS</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Track Source: </label>
                        <input type="file" name="film_track_src">
                    </div>
                </div>
            @else
            <div class="form-group">
                <label>Track (File Sub): </label>
                <div class="form-group">
                    <label>Track Type: </label>
                    <select class="form-control" name="film_track_type">
                        <option value="">Chọn track type</option>
                        <option value="vtt" @if(old('film_track_type') == 'vtt') selected @endif>.VTT</option>
                        <option value="ass" @if(old('film_track_type') == 'ass') selected @endif>.ASS</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Track Source: </label>
                    <input type="file" name="film_track_src">
                </div>
            </div>
            @endif{{-- if(count($film_track) == 1) --}}
            <div class="form-group">
                <label>Nguồn Episode: </label>
                <div>
                    <select class="form-control" name="film_src_name">
                        <option value="youtube" @if($film_episode->film_src_name == 'youtube') selected @endif>Youtube</option>
                        <option value="google photos" @if($film_episode->film_src_name == 'google photos') selected @endif>Google Photos</option>
                        <option value="google drive" @if($film_episode->film_src_name == 'google drive') selected @endif>Google Drive</option>
                    </select>
                </div>
            </div>
            
            <div class="form-group">
                <label>Source Episode</label>
                <div>
                    <textarea name="film_src_full" class="form-control" placeholder="Nhập URL trailer">{!! $film_episode->film_src_full !!}</textarea>
                </div>
            </div>
            <div class="form-group">
                <label>Source phim remote (không bắt buộc)</label>
                <textarea name="film_src_remote" class="form-control" placeholder="Nhập URL Remote">{!! $film_episode->film_src_remote !!}</textarea>
            </div>
            <div class="text-right">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                <button type="submit" class="btn btn-primary">Sửa Episode</button>
            </div> 
        </form>

    </div>
</div>
<script>
    $('.show-select-track').click(function(){
        $track = $('.track-edit');
        if($(this).is(':checked')){
            $track.removeClass('hidden');
            $track.addClass('show');
        }else{
            $track.removeClass('show');
            $track.addClass('hidden');
        }
        
    });
</script>
@endsection
