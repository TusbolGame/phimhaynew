@extends('admin.master')
@section('header')
<div class="col-lg-12">
    <h1 class="page-header bg-primary">Film
        <small>Edit</small>
    </h1>
</div>
@endsection
@section('content')
<div class="col-lg-12" style="padding-bottom:120px">
    <form action="{{ route('admin.film.getAdd') }}" method="POST" class="form-add-film">
        @include('admin.messages.messages')
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">

        <div class="col-lg-8">
            <div class="col-lg-5">
                <div class="form-group">
                    <label>Tên Tiếng Việt</label>
                    <textarea class="form-control" name="film_name_vn"  placeholder="Nhập tên phim tiếng việt">{{ old('film_name_vn') }}</textarea>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label>Tên Tiếng Anh, Nhật, ...</label>
                    <textarea class="form-control" name="film_name_en" placeholder="Nhập tên phim tiếng anh or nhật, ...">{{ old('film_name_en') }}</textarea>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label>Loại Phim<span class="text-danger">*</span></label>
                    <div>
                        <select name="film_category" class="form-control">
                            <option value="le" @if(old('film_category') == 'le') selected @endif>Phim Lẻ</option>
                            <option value="bo" @if(old('film_category') == 'bo') selected @endif>Phim Bộ</option>
                            <option value="hhle" @if(old('film_category') == 'hhle') selected @endif>Hoạt Hình Lẻ</option>
                            <option value="hhbo" @if(old('film_category') == 'hhbo') selected @endif>Hoạt Hình Bộ</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="form-group">
                <label>Nội Dung<span class="text-danger">*</span></label>
                <textarea name="film_info" class="form-control enter-data-tinymce" placeholder="Nhập nội dung phim">{{ old('film_time') }}</textarea>
            </div>
            <div class="col-lg-6">
                 <div class="form-group">
                    <label>Thời Lượng Phim
                        <span class="text-giai-thich"><i>Là số phút đối với phim lẻ, là số tập với phim bộ (chưa biết số tập, có thể bỏ trống)</i></span>
                    </label>
                    <input type="text" class="form-control" name="film_time" value="{{ old('film_time') }}" placeholder="Nhập thời lượng phim" autocomplete="off" />
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label>Điểm IMDB<span class="text-giai-thich"><i>Điểm của phim Mỹ, Châu Âu, ... từ 0 đến 10. Ex: 7.5</i></span></label>
                    <input type="number" class="form-control" name="film_score_imdb" value="{{ old('film_score_imdb') }}" min="0" max="10" step="0.1" placeholder="Số điểm IMDB" autocomplete="off" />
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label>Điểm AW<span class="text-giai-thich"><i>Điểm của phim Hàn quốc từ 0 đến 100. Ex: 60</i></span></label>
                    <input type="number" class="form-control" name="film_score_aw" value="{{ old('film_score_aw') }}" min="0" max="100" step="1" placeholder="Số điểm AW" autocomplete="off" />
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="form-group fix-height">
                <label class="col-xs-2 fix-left-col">Ngày Chiếu:</label>
                <div class="col-xs-3">
                    <select name="film_release_date_day" class="form-control">
                        <option value="??" selected="9">Ngày</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        <option value="22">22</option>
                        <option value="23">23</option>
                        <option value="24">24</option>
                        <option value="25">25</option>
                        <option value="26">26</option>
                        <option value="27">27</option>
                        <option value="28">28</option>
                        <option value="29">29</option>
                        <option value="30">30</option>
                        <option value="31">31</option>
                    </select>
                </div>
                <div class="col-xs-3">
                    <select name="film_release_date_month" class="form-control">
                        <option value="0" selected="1">Tháng</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                    </select>
                </div>
                <div class="col-xs-3">
                    <input type="text" class="form-control" name="film_release_date_year" value="" required="true" placeholder="Nhập năm">
                </div>
                
                
            </div>
            <!-- <div class="col-lg-3">
                <div class="form-group">
                    <label>Chất Lượng Phim<span class="text-danger">*</span></label>
                    <div>
                        <select name="film_quality" class="form-control">
                            <option value="SD" @if(old('film_quality') == 'SD') selected @endif>SD - 360p</option>
                            <option value="HD" @if(old('film_quality') == 'HD') selected @endif @if(!old('film_quality')) selected @endif>HD - 720p</option>
                            <option value="Full HD" @if(old('film_quality') == 'Full HD') selected @endif>Full HD - 1080p</option>
                            <option value="2K" @if(old('film_quality') == '2K') selected @endif>2K - 2160p</option>
                        </select>
                    </div>
                </div>
            </div> -->
            <!-- <div class="col-lg-3">
                <div class="form-group">
                    <label>Ngôn Ngữ<span class="text-danger">*</span></label>
                    <div>
                        <select name="film_language" class="form-control">
                            <option value="vs" @if(old('film_language') == 'vs') selected @endif>VietSub</option>
                            <option value="tm" @if(old('film_language') == 'tm') selected @endif>Thuyết Minh</option>
                            <option value="raw" @if(old('film_language') == 'lt') selected @endif>Lồng Tiếng</option>
                            <option value="es" @if(old('film_language') == 'es') selected @endif>EnlishSub</option>
                            <option value="raw" @if(old('film_language') == 'raw') selected @endif>Raw</option>
                        </select>
                    </div>
                </div>
            </div> -->
            <div class="clearfix"></div>
            <div class="col-lg-10">
                <div class="form-group">
                    <label>Thể Loại<span class="text-danger">*</span></label>
                    <div class="enter-data-ul">
                        <ul>
                            <li><label><input type="checkbox" name="film_type[]" value="chien-tranh">Phim chiến tranh</label></li>
                            <li><label><input type="checkbox" name="film_type[]" value="co-trang">Phim cổ trang</label></li>
                            <li><label><input type="checkbox" name="film_type[]" value="gia-tuong">Phim giả tưởng</label></li>
                            <li><label><input type="checkbox" name="film_type[]" value="hai-huoc">Phim hài hước</label></li>
                            <li><label><input type="checkbox" name="film_type[]" value="hanh-dong">Phim hành động</label></li>
                            <li><label><input type="checkbox" name="film_type[]" value="hinh-sự">Phim hình sự</label></label></li>
                            <li><label><input type="checkbox" name="film_type[]" value="hoc-duong">Phim học đường</label></li>
                            <li><label><input type="checkbox" name="film_type[]" value="kinh-di">Phim kinh dị</label></label></li>
                            <li><label><input type="checkbox" name="film_type[]" value="hoi-hop-gay-can">Phim hồi hộp gây cấn</label></label></li>
                            <li><label><input type="checkbox" name="film_type[]" value="phep-thuat">Phim phép thuật</label></li>
                            <li><label><input type="checkbox" name="film_type[]" value="phieu-luu">Phim phiêu lưu</label></label></li>
                            <li><label><input type="checkbox" name="film_type[]" value="sieu-nhien">Phim siêu nhiên</label></li>
                            <li><label><input type="checkbox" name="film_type[]" value="tam-ly">Phim tâm lý</label></label></li>
                            <li><label><input type="checkbox" name="film_type[]" value="tinh-cam">Phim tình cảm</label></li>
                            <li><label><input type="checkbox" name="film_type[]" value="tai-lieu">Phim tài liệu</label></li>
                            <li><label><input type="checkbox" name="film_type[]" value="than-thoai">Phim thần thoại</label></li>
                            <li><label><input type="checkbox" name="film_type[]" value="trinh-tham">Phim trinh thám</label></li>
                            <li><label><input type="checkbox" name="film_type[]" value="vo-thuat">Phim võ thuật</label></label></li>
                            <li><label><input type="checkbox" name="film_type[]" value="vien-tuong">Phim viễn tưởng</label></label></li>
                            <li><label><input type="checkbox" name="film_type[]" value="zombie">Phim Zombie</label></li>   
                            
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-10">
                <div class="form-group">
                    <label>Quốc Gia</label>
                    <div class="enter-data-ul">
                        <ul>
                            <li><label><input type="checkbox" name="film_country[]" value="anh">Phim Anh</label></li>
                            <li><label><input type="checkbox" name="film_country[]" value="an-do">Phim Ấn Độ</label></li>
                            <li><label><input type="checkbox" name="film_country[]" value="au-my">Phim Âu-Mỹ</label></li>
                            <li><label><input type="checkbox" name="film_country[]" value="dai-loan">Phim Đài Loan</label></li>
                            <li><label><input type="checkbox" name="film_country[]" value="han-quoc">Phim Hàn Quốc</label></li>
                            <li><label><input type="checkbox" name="film_country[]" value="hong-kong">Phim Hồng Kông</label></li>
                            <li><label><input type="checkbox" name="film_country[]" value="my">Phim Mỹ</li>
                            <li><label><input type="checkbox" name="film_country[]" value="nga">Phim Nga</label></li>
                            <li><label><input type="checkbox" name="film_country[]" value="nhat-ban">Phim Nhật</label></li>
                            <li><label><input type="checkbox" name="film_country[]" value="viet-nam">Phim Việt Nam</label></li>
                            <li><label><input type="checkbox" name="film_country[]" value="thai-lan">Phim Thái Lan</label></li>
                            <li><label><input type="checkbox" name="film_country[]" value="trung-quoc">Phim Trung Quốc</label></li>
                            <li><label><input type="checkbox" name="film_country[]" value="quoc-gia-khac">Phim QG khác</label></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Đạo Diễn:</label>
                    <span class="text-giai-thich"><i>Nếu có nhiều đạo diễn thì cách nhau bằng dấu phẩy và khoảng trắng ', '</i></span>
                    <span class="text-giai-thich"><i>Ex: Director 1, Director 2</i></span>
                    <textarea name="film_director" class="form-control" placeholder="Nhập tên đạo diễn" >{{ old('film_director') }}</textarea>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Diễn Viên:</label>
                    <span class="text-giai-thich"><i>Nếu có nhiều diễn viên thì cách nhau bằng dấu phẩy và khoảng trắng ', '</i></span>
                    <span class="text-giai-thich"><i>Ex: Actor 1, Actor 2</i></span>
                    <textarea name="film_actor" class="form-control" placeholder="Nhập tên diễn viên" >{{ old('film_actor') }}</textarea>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Hãng Sản Xuất:</label>
                    <span class="text-giai-thich"><i>Nếu có nhiều cty sx thì cách nhau bằng dấu phẩy và khoảng trắng ', '</i></span>
                    <span class="text-giai-thich"><i>Ex: Company A, Company B</i></span>
                    <textarea name="film_production_company" class="form-control" placeholder="Nhập tên hãng sản xuất" >{{ old('film_production_company') }}</textarea>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Từ Khóa:</label>
                    <span class="text-giai-thich"><i>Nếu có nhiều từ khóa thì mỗi từ khóa được cách nhau bằng dấu phẩy và khoảng trắng ', '</i></span>
                    <span class="text-giai-thich"><i>Ex: Key word 1, key word 2</i></span>
                    <textarea name="film_key_words" class="form-control" placeholder="Nhập tên từ khóa" >{{ old('film_key_words') }}</textarea>
                </div>
            </div>
            <div class="form-group">
                <label>Phim Liên Quan:</label>
                <p><em>Không có phim liên quan</em></p>
                <div class="form-group">
                    <label><input type="checkbox" name="film_relate_no" value="1" checked="true">Không có phim liên quan</label>
                </div>
                <p><em>Hoặc Tìm kiếm: phim liên quan</em></p>
                <div class="input-group">
                    <input type="text" class="form-control search-film-relate" placeholder="Tìm kiếm phim liên quan">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">Search!</button>
                    </span>
                </div><!-- /input-group -->
                <div class="search-relate-result">
                    <h6>Kết quả: <p class="text-danger search-film-relate-key"></p></h6>
                    <ul>
                        <!-- <li>
                            <label><input type="radio" name="film_relate_selected">567</label>  
                        </li> -->
                    </ul>
                </div>
                
                <p><em>Hoặc Thêm phim liên quan <span class="text-danger">mới</span></em></p>
                <div class="input-group">
                    <input type="text" class="form-control" name="film_relate_new" placeholder="Nhập phim liên quan mới">
                </div>
                <script>
                    function removeSearchFilmRelate(){
                        $('.search-relate-result ul li').remove();
                    }
                    function showSearchFilmRelate(){
                        $('.search-relate-result').show();
                    }
                    function hideSearchFilmRelate(){
                        $('.search-relate-result').hide();
                    }
                    function addSearchFilmRelate($relate_id, $relate_name){
                        $relate = '<li><label><input type="radio" name="film_relate_selected" value="'+$relate_id+'">'+$relate_name+'</label></li>';
                        //append
                        $('.search-relate-result ul').append($relate);
                    }
                    //click close search film relate result

                    $('.search-film-relate').click(function() {
                        //autocomplete
                        $(this).keyup(function() {
                            //goi ajax
                            var data = {
                                //token
                                _token : $('form.form-add-film').children('input[name="_token"]').val(),
                                search_film_relate : $('.search-film-relate').val()
                            };
                            $.ajax({
                                type : 'POST',
                                dataType : 'json',
                                url : '{!! route('filmAjax.getSearchFilmRelate') !!}',
                                data : data,
                                success : function (result){
                                    //goi remove
                                    removeSearchFilmRelate();
                                    $('.search-film-relate-key').text(data['search_film_relate']);
                                    if(result != null){
                                        var dk = result.length;
                                        var i = 0;
                                        while(i < dk){ 
                                            addSearchFilmRelate(result[i]['id'], result[i]['film_relate_name']);                     
                                            i++;
                                        }
                                        //show
                                        showSearchFilmRelate();
                                    }

                                },
                                error : function (){
                                    console.log('Lỗi xử lý đường truyền');
                                }
                            });
                        });

                    });
                </script>
            </div>
            <div>
                <div class="form-group">
                    <label>Đạo diễn</label><br>
                    <div class="director-list">
                        <ol>
                            <!-- <li>
                                <input type="hidden" name="derector_id[]" value="">
                                <span>ABC</span>
                                <button type="button" class="btn btn-default btn-remove-director">Xóa</button>
                            </li> -->
                        </ol>
                    </div>
                    <label>Tìm kiếm đạo diễn</label>
                    <div class="input-group">
                        <input type="text" class="search-film-director form-control" placeholder="Đạo diễn">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Search!</button>
                        </span>
                    </div><!-- /input-group -->
                    <div class="search-result-film-director">
                        <ol>
                            <!-- <li>
                                <input type="hidden" name="search-result-director-id" value="1" disabled="true">
                                <span class="search-result-director-name">Chon</span>
                                <button type="button" class="btn btn-default btn-add-director">Thêm</button>
                            </li> -->
                        </ol>
                    </div>
                    <button type="button" class="btn btn-success show-film-person-director">Thêm đạo diễn mới</button>
                </div>
                <div class="form-group">
                    <label>Diễn viên</label><br>
                    <div class="actor-list">
                        <ol>
                           <!--  <li>
                                <input type="hidden" name="actor_id[]" value="">
                                <span>ABC</span>
                                <div class="col-sm-4 actor-character">
                                    <input type="text" class="form-control" name="actor_character[]" value="" placeholder="ABC trong vai">
                                </div>
                                <button type="button" class="btn btn-default btn-remove-actor">Xóa</button>
                            </li> -->
                        </ol>
                    </div>
                    <label>Tìm kiếm diễn viên</label>
                    <div class="input-group">
                        <input type="text" class="search-film-actor form-control" placeholder="Diễn viên">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Search!</button>
                        </span>
                    </div><!-- /input-group -->
                    <div class="search-result-film-actor">
                        <ol>
                            <!-- <li>
                                <input type="hidden" name="search-result-actor-id" value="1" disabled="true">
                                <span class="search-result-actor-name">Chon</span>
                                <button type="button" class="btn btn-default btn-add-actor">Thêm</button>
                            </li> -->
                        </ol>
                    </div>
                    <button type="button" class="btn btn-success show-film-person-actor">Thêm diễn viên mới</button>
                </div>
            </div>
        </div> <!-- ./col-lg-8 -->

         <div class="col-lg-4">
        
            <div class="form-group">
                <label>Ảnh Thumbnail small (300x400)</label>
                <textarea name="film_thumbnail_small" class="form-control" placeholder="Nhập URL ảnh thumnail small" >{{ old('film_thumbnail_small') }}</textarea>
            </div>
            <div class="form-group">
                <label>Ảnh Thumbnail big (450x600)</label>
                <textarea name="film_thumbnail_big" class="form-control" placeholder="Nhập URL ảnh thumnail big" >{{ old('film_thumbnail_big') }}</textarea>
            </div>
            <div class="form-group">
                <label>Ảnh Poster Video</label>
                <textarea name="film_poster_video" class="form-control" placeholder="Nhập URL ảnh poster video" >{{ old('film_poster_video') }}</textarea>
            </div>
            <div class="form-group">           
                <label>Trailer</label><br>
                <label>Nguồn Trailer: </label>
                <div>
                    <select class="form-control" name="film_src_name">
                        <option value="youtube">Youtube</option>
                        <option value="google photos">Google Photos</option>
                        <option value="google drive">Google Drive</option>
                    </select>
                </div>
                <label>Source Trailer</label>
                <div>
                    <textarea name="film_src_full" class="form-control" placeholder="Nhập URL trailer"></textarea>
                </div>
                <label>Ngôn Ngữ Trailer:</label>
                <div>
                    <select name="film_episode_language" class="form-control">
                        <option value="vs">VietSub</option>
                        <option value="tm">Thuyết Minh</option>
                        <option value="lt">Lồng Tiếng</option>
                        <option value="es">EnlishSub</option>
                        <option value="raw">Raw</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Thêm Phim Mới</button>
            <button type="reset" class="btn btn-default">Reset</button>
        </div>
        
    <form>
</div>
@include('admin.film.modal-add-film-person-director', $film_job)
@include('admin.film.modal-add-film-person-actor', $film_job)
@endsection
