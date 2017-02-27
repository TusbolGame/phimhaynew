@extends('admin.master')
@section('header')
<div class="col-lg-12">
    <h1 class="page-header bg-primary">Report Error - Chi tiết báo lỗi
        <small class="text-danger">Show</small>
    </h1>
</div>
@endsection
@section('content')
<div class="col-lg-12" style="padding-bottom:120px">
    <table class="table">
        <caption>Thông tin lỗi</caption>
        <tbody>
            <tr>
                <th>ID</th>
                <td>{!! $film_report_error->id !!}</td>
            </tr>
            <tr>
                <th>Error Name</th>
                <td>{!! $film_report_error->report_error_name !!}</td>
            </tr>
            <tr>
                <th>Film ID</th>
                <td>
                    <ul>
                        <li><span>Admin:</span><a href="{!! route('admin.film.getShow', [$film_report_error->filmList->id]) !!}">{!! $film_process->getFilmNameVnEn($film_report_error->filmList->film_name_vn, $film_report_error->filmList->filmfilm_name_en) !!}</a>
                        </li>
                        <li>
                            <span>Film-Info:</span>
                            <a href="{!! route('film.getFilm', [$film_report_error->filmList->film_dir_name, $film_report_error->filmList->id]) !!}">{!! $film_process->getFilmNameVnEn($film_report_error->filmList->film_name_vn, $film_report_error->filmList->filmfilm_name_en) !!}</a>
                        </li>
                    </ul>
                </td>
            </tr>
            <tr>
                <th>User</th>
                <td>{!! $film_report_error->user->username !!}</td>
            </tr>
            <tr>
                <th>Created_at</th>
                <td>{!! $film_report_error->created_at !!}</td>
            </tr>
            <tr>
                <th>Delete</th>
                <td>
                    <form action="{!! route('admin.report-error.destroy', $film_report_error->id) !!}" method="POST" accept-charset="utf-8">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="id" value="{!! $film_report_error->id !!}">
                        <button type="submit" onclick="return checkDelete('Bạn có muốn xóa Report Id: {!! $film_report_error->id !!} ?');">Xóa</button>
                    </form>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
