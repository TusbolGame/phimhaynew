@extends('phimhay.master')
@section('title', 'Thông tin thành viên - PhimHay')
@section('description', 'Thông tin thành viên')
@section('content')
<div class="div-center div-profile">
    <div class="container-fluid">
        <div class="user-login">
            <h3 class="text-center">Thông tin thành viên</h3>
            <hr>

            <div class="user-info">
                <div class="user-img">
                    <img src="@if(substr(Auth::user()->image, 0, 4) == 'icon') {!! url('resources/photos/'.Auth::user()->image) !!} @else{!! Auth::user()->image !!}@endif" class="img-circle" alt="Img User Profile">
                </div>
                @include('admin.messages.messages')
                @include('phimhay.message.success')
                <div class="user-detail">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>Tên tài khoản</td>
                                <td>{!! Auth::user()->username !!}</td>
                            </tr>
                            <tr>
                                <td>Tên</td>
                                <td>{!! Auth::user()->first_name !!}</td>
                            </tr>
                            <tr>
                                <td>Họ</td>
                                <td>{!! Auth::user()->last_name !!}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>{!! $email !!}</td>
                            </tr>
                            <tr>
                                <td>Ngày Tạo Tài Khoản</td>
                                <td>{!! Auth::user()->created_at !!}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="user-setting">
                        <ul>
                            <li><a href="" class="btn btn-info" data-toggle="modal" data-target=".modal-user-change-info" title="">Thay đổi thông tin</a></li>
                            <li><button class="btn btn-success" data-toggle="modal" data-target=".modal-user-change-pass">Thay đổi mật khẩu</button></li>
                            <li><button class="btn btn-danger" data-toggle="modal" data-target=".modal-check-delete-user">Xóa tài khoản</button></li>
                        </ul>
                    </div>
                    <div class="modal fade modal-check-delete-user" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
                      <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="gridSystemModalLabel">Xóa Tài Khoản</h4>
                          </div>
                          <div class="modal-body">
                            <h5>Bạn có thực sự muốn <strong class="bg-danger">Xóa</strong> tài khoản</h5>
                            <form action="{!! route('user.postDelete') !!}" class="form" method="post" accept-charset="utf-8">
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                                
                                <div class="form-group">
                                    <label>Mật khẩu</label>
                                    <input type="password" class="form-control" name="password" value="" placeholder="Nhập mật khẩu">
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-danger text-center">Xóa Tài Khoản</button>
                                </div>
                            </form>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                          </div>
                        </div><!-- /.modal-content -->
                      </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                    <!-- modal change password -->
                    <div class="modal fade modal-user-change-pass" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
                      <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="gridSystemModalLabel">Thay Đổi Mật Khẩu</h4>
                          </div>
                          <div class="modal-body">
                            <form action="{!! route('user.postChangePassword') !!}" class="form" method="post" accept-charset="utf-8">
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password" value="" placeholder="Mật khẩu cũ">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password_new" value="" placeholder="Mật khẩu mới">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="repassword_new" value="" placeholder="Xác nhận Mật khẩu mới">
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success text-center">Thay Đổi Mật Khẩu</button>
                                </div>
                            </form>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                            <!-- <button type="button" class="btn btn-primary"></button> -->
                            <!-- <a href="{!! route('auth.getLogout') !!}" class="btn btn-primary" title="">Thay Đổi</a> -->
                          </div>
                        </div><!-- /.modal-content -->
                      </div><!-- /.modal-dialog -->
                    </div><!-- /.modal --> 
                    <!-- end modal change password -->
                    <!-- modal change info user -->
                    <div class="modal fade modal-user-change-info" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
                      <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="gridSystemModalLabel">Thay Đổi Thông Tin</h4>
                          </div>
                          <div class="modal-body">
                            <form action="{!! route('user.postChangeInfo') !!}" class="form" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                                <div class="form-group">
                                    <label>Tài Khoản<span class="text-danger">*</span></label>
                                    <input class="form-control" value="{!! Auth::user()->username !!}" disabled />
                                </div>
                                <div class="form-group">
                                    <label>Tên<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="txtFirstName" value="{!! Auth::user()->first_name !!}" placeholder="Tên" required="true" />
                                </div>
                                <div class="form-group">
                                    <label>Họ<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="txtLastName" value="{!! Auth::user()->last_name !!}" placeholder="Họ" required="true" />
                                </div>
                                <div class="form-group">
                                    <label>Email<span class="text-danger">*</span>: <i>Khôi phục mật khẩu</i><br>
                                    </label>
                                    <em>{!! $email !!}</em>
                                    <input type="email" class="form-control" name="txtEmail" placeholder="Nhập email cần thay đổi" />
                                </div>
                                <div class="form-group">
                                    <label>Ảnh đại diện:</label><br>
                                    <label>Mặc định <img src="@if(substr(Auth::user()->image, 0, 4) == 'icon'){!! url('resources/photos/'.Auth::user()->image) !!}@else{!! Auth::user()->image !!}@endif" class="user-avata" alt="Error Image User"></label><br>
                                    <label>Ảnh khác</label><input type="file" class="" name="fileImageUser" accept="image/*" />
                                    
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-info text-center">Thay Đổi Thông Tin</button>
                                </div>
                            </form>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                          </div>
                        </div><!-- /.modal-content -->
                      </div><!-- /.modal-dialog -->
                    </div><!-- /.modal --> 
                    <!-- end modal change info user -->
                </div>
            </div>
            
        </div>
    </div>
</div>
<div class="film-new">
    @if (count($film_user_tick) > 0)
    <div class="list-film-new">
        <div class="film-new-title">
            <span><span class="glyphicon glyphicon-pencil"></span> PHIM ĐÁNH DẤU ({!! $total_user_tick !!})</span>
            <span class="link-list-person"><a href="{!! route('user.getFilmUserTick', Auth::user()->id) !!}" class="btn btn-link">Xem danh sách</a></span>
        </div>
        <ul class="list-film-new-ul list-film-person">
            @foreach ($film_user_tick as $film)
            <li>
                <a href="{!! route('film.getFilm', [$film->filmList->film_dir_name, $film->filmList->id]) !!}" title="">
                    <div class="film-new-thumbnail">
                        <img src="{!! $film->filmList->film_thumbnail_small !!}" alt="Error Thumbnail small">
                        <div class="film-ribbon-status"><span>{!! $film->filmList->film_status !!}</span></div>
                        <div class="film-ribbon-language"><span>{!! $film_process->xulyGetFilmLanguage($film->filmList->film_language) !!}</span></div>
                    </div>
                    <div class="film-new-detail">
                        <span class="film-title-vn">{!! $film_process->getFilmNameVn($film->filmList->film_name_vn, $film->filmList->film_name_en) !!}</span>
                        <span class="film-title-en">{!! $film_process->getFilmNameEn($film->filmList->film_name_vn, $film->filmList->film_name_en) !!}</span>
                        <span class="film-title-time">{!! $film_process->xulyGetFilmTime($film->filmList->film_time, $film->filmList->film_category) !!}</span>
                        <span class="film-title-year">{!! $film->filmList->film_years !!}</span>
                    </div>
                </a>
            </li>
            @endforeach
        </ul>
    </div>
    @endif
    @if (count($film_user_watch) > 0)
    <div class="list-film-new">
        <div class="film-new-title">
            <span><span class="glyphicon glyphicon-film"></span> PHIM ĐÃ XEM ({!! $total_user_watch !!})</span>
            <span class="link-list-person"><a href="{!! route('user.getFilmUserWatch', Auth::user()->id) !!}" class="btn btn-link">Xem danh sách</a></span>
        </div>
        <ul class="list-film-new-ul list-film-person">
            @foreach ($film_user_watch as $film)
            <li>
                <a href="{!! route('film.getFilm', [$film->filmList->film_dir_name, $film->filmList->id]) !!}" title="">
                    <div class="film-new-thumbnail">
                        <img src="{!! $film->filmList->film_thumbnail_small !!}" alt="Error Thumbnail small">
                        <div class="film-ribbon-status"><span>{!! $film->filmList->film_status !!}</span></div>
                        <div class="film-ribbon-language"><span>{!! $film_process->xulyGetFilmLanguage($film->filmList->film_language) !!}</span></div>
                    </div>
                    <div class="film-new-detail">
                        <span class="film-title-vn">{!! $film_process->getFilmNameVn($film->filmList->film_name_vn, $film->filmList->film_name_en) !!}</span>
                        <span class="film-title-en">{!! $film_process->getFilmNameEn($film->filmList->film_name_vn, $film->filmList->film_name_en) !!}</span>
                        <span class="film-title-time">{!! $film_process->xulyGetFilmTime($film->filmList->film_time, $film->filmList->film_category) !!}</span>
                        <span class="film-title-year">{!! $film->filmList->film_years !!}</span>
                    </div>
                </a>
            </li>
            @endforeach
        </ul>
    </div>
    @endif
</div>
@stop