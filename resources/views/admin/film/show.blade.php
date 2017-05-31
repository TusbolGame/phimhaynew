@extends('admin.master')
@section('header')
<div class="col-lg-12">
    <h1 class="page-header bg-primary">{!! $film_process->getFilmNameVnEn($film_list->film_name_vn, $film_list->film_name_en) !!}
        <small class="text-danger">Edit</small>
    </h1>
</div>
@endsection
@section('content')
<div class="clearfix"></div>
@if(Session::has('film_errors'))
    <div class="alert alert-danger">
        <ul>
            @foreach(Session::get('film_errors') as $key)
                <li>{!! $key !!}</li>
            @endforeach
        </ul>
    </div>
@endif
@if(Session::has('film_successes'))
    <div class="alert alert-success">
        <ul>
            @foreach(Session::get('film_successes') as $key)
                <li>{!! $key !!}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="col-lg-12 admin-detail">
    <div class="col-lg-6">
        <a href="{!! route('admin.film.getEdit', $film_list->id) !!}" class="btn btn-success">Chỉnh sửa thông tin phim</a>
        <a href="{!! route('film.getFilm', [$film_list->film_dir_name, $film_list->id]) !!}" class="btn btn-info">Xem phim</a><br><br>
        <a href="{!! route('admin.film.getCheckLink', $film_list->id) !!}" class="btn btn-primary">Check Link Poster</a>
        <br><br>
        <a href="{!! route('admin.film.episode.getList', [$film_list->id]) !!}" class="btn btn-info">Danh sách Episode <span class="badge">{!! $total_film_episode !!}</span></a>
        <a href="{!! route('admin.film.episode.getAdd', [$film_list->id]) !!}" class="btn btn-success">Thêm Episode</a>
        <h4>Thông tin phim</h4>
        <table class="table table-striped table-bordered fix-word-break">
            <tbody>
                <tr>
                    <th>Tên Tiếng Việt</th>
                    <td>{!! $film_list->film_name_vn !!}</td>
                </tr>
                <tr>
                    <th>Tên Tiếng Anh</th>
                    <td>{!! $film_list->film_name_en !!}</td>
                </tr>
                <tr>
                    <th>Phim</th>
                    <td>{!! $film_process->xulyGetFilmKind($film_detail->film_kind) !!}</td>
                </tr>
                <tr>
                    <th>Phim Loại</th>
                    <td>{!! $film_process->xulyGetFilmCategory($film_list->film_category) !!}</td>
                </tr>
                <tr>
                    <th>Nội Dung</th>
                    <td class="film-content-info">{!! $film_detail->film_info !!}</td>
                </tr>
                <tr>
                    <th>Thời Lượng Phim</th>
                    <td>{!! $film_process->xulyGetFilmTime($film_list->film_time, $film_list->film_category) !!}</td>
                </tr>
                <tr>
                    <th>Điểm IDMB</th>
                    <td>{!! $film_detail->film_score_idmb !!}</td>
                </tr>
                <tr>
                    <th>Điểm AW</th>
                    <td>{!! $film_detail->film_score_aw !!}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-lg-6">
        <a class="btn btn-danger" onclick="return checkDelete('Bạn có muốn xóa Film Name: {!! $film_process->getFilmNameVnEn($film_list->film_name_vn, $film_list->film_name_en) !!} không?');" href="{!! route('admin.film.getDelete', [$film_detail->id]) !!}"> Xóa Phim</a>
        <br><br>
        <table class="table table-striped table-bordered fix-word-break">
            <tbody>
                <tr>
                    <th>Src Youtube Trailer</th>
                    <td>{!! $film_detail->src_youtube_trailer !!}</td>
                </tr>
                <tr>
                    <th>Ngày Chiếu</th>
                    <td>{!! $film_detail->film_release_date !!}</td>
                </tr>
                <tr>
                    <th>Chất Lượng</th>
                    <td>{!! $film_list->film_quality !!}</td>
                </tr>
                <tr>
                    <th>Ngôn Ngữ</th>
                    <td>{!! $film_list->film_language !!}</td>
                </tr>
                <tr>
                    <th>Thể Loại</th>
                    <!-- <td>{!! $film_detail->film_type !!}</td> -->
                    <td>
                        <ul>
                            @foreach ($film_detail_type as $data)
                            <li>{!! $data->filmType->type_name !!}</li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
                <tr>
                    <th>Quốc Gia</th>
                    <!-- <td>{!! $film_detail->film_country !!}</td> -->
                    <td>
                        <ul>
                            @foreach ($film_detail_country as $data)
                            <li>{!! $data->filmCountry->country_name !!}</li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
                <tr>
                    <th>Đạo Diễn</th>
                    <td>
                        <ul>
                            @foreach ($film_director as $director)
                            <li><a href="{!! route('admin.person.getEdit', $director->filmPerson->id) !!}" title="">{!! $director->filmPerson->person_name !!}</a></li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
                <tr>
                    <th>Diễn Viên</th>
                    <td>
                        <ul>
                            @foreach ($film_actor as $actor)
                            <li><a href="{!! route('admin.person.getEdit', $actor->filmPerson->id) !!}" title="">{!! $actor->filmPerson->person_name !!} ({!! $actor->actor_character !!})</a></li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
                <tr>
                    <th>Hãng Sản Xuất</th>
                    <td>{!! $film_detail->film_production_company !!}</td>
                </tr>
                <tr>
                    <th>Từ Khóa</th>
                    <td>{!! $film_detail->film_key_words !!}</td>
                </tr>
                <tr>
                    <th>Lượt Xem</th>
                    <td>{!! $film_list->film_viewed !!}</td>
                </tr>
                <tr>
                    <th>Điểm Đánh Giá</th>
                    <td>{!! $film_list->film_vote !!} ({!! $film_list->film_vote_count !!} lượt)</td>
                </tr>
                <tr>
                    <th>Đường dẫn</th>
                    <td>{!! $film_list->film_dir_name !!}</td>
                </tr>
                <tr>
                    <th class="bg-danger">Trạng Thái</th>
                    <td>{!! $film_list->film_status !!}</td>
                </tr>
                <tr>
                    <th>Phim Liên Quan</th>
                    <td>{!! $film_detail->filmRelate->film_relate_name !!}</td>
                </tr>
                <tr>
                    <th>Ảnh Thumnail small</th>
                    <td>{!! $film_list->film_thumbnail_small !!}</td>
                </tr>
                <tr>
                    <th>Ảnh Thumnail big</th>
                    <td>{!! $film_detail->film_thumbnail_big !!}</td>
                </tr>
                <tr>
                    <th>Ảnh Poster Video</th>
                    <td>{!! $film_detail->film_poster_video !!}</td>
                </tr>
                
            </tbody>
        </table>
    </div>
</div>
@endsection
