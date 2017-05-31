@extends('admin.master')
@section('header')
<div class="col-lg-12">
    <h1 class="page-header bg-primary">Danh Sách Phim</h1>
</div>
@endsection
@section('content')
<div class="col-lg-12 admin-detail">
    <table class="table table-bordered table-hover table-striped">
        <caption>Danh sách</caption>
        <thead>
            <tr>
                <th>ID</th>
                <th>Poster</th>
                <th>Tên Tiếng Việt</th>
                <th>Tên Tiếng Anh</th>
                <th>Trạng Thái</th>
                <th>Source Trailer</th>
                <th>Ngày Update</th>
                <th>Ngày Tạo</th>
                <th>Xem Chi Tiết</th>
                <th>Chỉnh Sửa</th>
                <th>Xóa</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($films as $film)
                <tr>
                    <td>{!! $film->id !!}</td>
                    <td>
                        <img src="{!! $film->filmList->film_thumbnail_small !!}" alt="Error Poster" width="100" height="133">
                    </td>
                    <td>{!! $film->filmList->film_name_vn !!}</td>
                    <td>{!! $film->filmList->film_name_en !!}</td>
                    <td>{!! $film->filmList->film_status !!}</td>
                    <td>{!! $film->src_youtube_trailer !!}</td>
                    <td title="{!! $film->updated_at !!}">{!! \Carbon\Carbon::createFromTimestamp(strtotime($film->updated_at))->diffForHumans() !!}</td>
                    <td title="{!! $film->created_at !!}">{!! \Carbon\Carbon::createFromTimestamp(strtotime($film->created_at))->diffForHumans() !!}</td>
                    <td><a href="{!! route('admin.film.getShow', $film->id) !!}">Xem</a></td>
                    <td><a href="{!! route('admin.film.getEdit', $film->id) !!}">Sửa</a></td>
                    <td>
                        <a onclick="return checkDelete('Bạn có muốn xóa Film Name: {!! $film_process->getFilmNameVnEn($film->filmList->film_name_vn, $film->filmList->film_name_en) !!} không?');" href="{!! route('admin.film.getDelete', [$film->id]) !!}"> Xóa</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <?php echo $films->render(); ?>
</div>
@endsection
