@extends('admin.master')
@section('header')
<div class="col-lg-12">
    <h1 class="page-header bg-primary">{!! $film_process->getFilmNameVnEn($film_list->film_name_vn, $film_list->film_name_en) !!}
        <small>Edit</small>
    </h1>
</div>
@endsection
@section('content')
<div class="col-lg-12" style="padding-bottom:120px">
    <form action="{{ route('admin.film.getEdit', $film_id) }}" method="POST" class="form-add-film">
        @include('admin.messages.messages')
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">

        <div class="col-lg-8">
            <div class="col-lg-5">
                <div class="form-group">
                    <label>Tên Tiếng Việt</label>
                    <textarea class="form-control" name="film_name_vn"  placeholder="Nhập tên phim tiếng việt">{!! $film_list->film_name_vn !!}</textarea>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label>Tên Tiếng Anh, Nhật, ...</label>
                    <textarea class="form-control" name="film_name_en" placeholder="Nhập tên phim tiếng anh or nhật, ...">{!! $film_list->film_name_en !!}</textarea>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label>Loại Phim<span class="text-danger">*</span></label>
                    <div>
                        <select name="film_category" class="form-control">
                            <option value="le" @if($film_detail->film_category == 'le') selected @endif>Phim Lẻ</option>
                            <option value="bo" @if($film_detail->film_category == 'bo') selected @endif>Phim Bộ</option>
                            <option value="hhle" @if($film_detail->film_category == 'hhle') selected @endif>Hoạt Hình Lẻ</option>
                            <option value="hhbo" @if($film_detail->film_category == 'hhbo') selected @endif>Hoạt Hình Bộ</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="form-group">
                <label>Nội Dung<span class="text-danger">*</span></label>
                <textarea name="film_info" class="form-control enter-data-tinymce" placeholder="Nhập nội dung phim">{{ $film_detail->film_info }}</textarea>
            </div>
            <div class="col-lg-6">
                 <div class="form-group">
                    <label>Thời Lượng Phim
                        <span class="text-giai-thich"><i>Là số phút đối với phim lẻ, là số tập với phim bộ (chưa biết số tập, có thể bỏ trống)</i></span>
                    </label>
                    <input type="text" class="form-control" name="film_time" value="{{ $film_list->film_time }}" placeholder="Nhập thời lượng phim" autocomplete="off" />
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label>Điểm IMDB<span class="text-giai-thich"><i>Điểm của phim Mỹ, Châu Âu, ... từ 0 đến 10. Ex: 7.5</i></span></label>
                    <input type="number" class="form-control" name="film_score_imdb" value="{{ $film_detail->film_score_imdb }}" min="0" max="10" step="0.1" placeholder="Số điểm IMDB" autocomplete="off" />
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label>Điểm AW<span class="text-giai-thich"><i>Điểm của phim Hàn quốc từ 0 đến 100. Ex: 60</i></span></label>
                    <input type="number" class="form-control" name="film_score_aw" value="{{ $film_detail->film_score_aw }}" min="0" max="100" step="1" placeholder="Số điểm AW" autocomplete="off" />
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="form-group fix-height">
                <label class="col-xs-2 fix-left-col">Ngày Chiếu:</label>
                <?php 
                    $date = explode('-', $film_detail->film_release_date);
                 ?>
                <div class="col-xs-3">
                    <input type="text" name="film_release_date_day" class="form-control" value="@if( count($date) == 3 && isset($date[0])){!! $date[0] !!}@endif" placeholder="Nhập ngày">
                </div>
                <div class="col-xs-3">
                    <input type="text" name="film_release_date_month" class="form-control" value="@if (count($date) == 3 && isset($date[1])){!! $date[1] !!}@endif" placeholder="Nhập tháng">
                </div>
                <div class="col-xs-3">
                    <input type="text" name="film_release_date_year" class="form-control" value="@if (count($date) == 3 && isset($date[2])){!! $date[2] !!}@endif" required="true" placeholder="Nhập năm">
                </div>
                
                
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label>Chất Lượng Phim<span class="text-danger">*</span></label>
                    <div>
                        <select name="film_quality" class="form-control">
                            <option value="720p" @if($film_list->film_quality == '720p') selected @endif>720p</option>
                            <option value="360p" @if($film_list->film_quality == '360p') selected @endif>360p</option>
                            <option value="480p" @if($film_list->film_quality == '480p') selected @endif>480p</option>
                            <option value="1080p" @if($film_list->film_quality == '1080p') selected @endif>1080p</option>
                            <option value="2160p" @if($film_list->film_quality == '2160p') selected @endif>2160p</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label>Ngôn Ngữ<span class="text-danger">*</span></label>
                    <div>
                    <?php 
                        $data = explode(',', $film_list->film_language);
                        $film_language = [
                            'vs' => '', 'tm' => '', 'lt' => '', 'es' => '', 'raw' => ''
                        ];
                        foreach ($data as $language) {
                            $film_language[$language] = 'selected';
                        }
                     ?>
                        <select name="film_language[]" class="form-control" multiple="true">
                            <option value="vs" {!! $film_language['vs'] !!}>VietSub</option>
                            <option value="tm" {!! $film_language['tm'] !!}>Thuyết Minh</option>
                            <option value="lt" {!! $film_language['lt'] !!}>Lồng Tiếng</option>
                            <option value="es" {!! $film_language['es'] !!}>EnlishSub</option>
                            <option value="raw" {!! $film_language['raw'] !!}>Raw</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-lg-10">
                <div class="form-group">
                    <label>Thể Loại<span class="text-danger">*</span></label>
                    <div class="enter-data-ul">
                        <ul>
                            <?php 
                                $data = explode(',', $film_detail->film_type);
                                $film_type = array(
                                    'chien-tranh'=>'', 'co-trang'=>'', 'hai-huoc'=>'',
                                    'hanh-dong'=>'', 'hinh-su'=>'', 'kinh-di'=>'', 
                                    'hoi-hop-gay-can'=>'',
                                    'phieu-luu'=>'', 'vo-thuat'=>'', 'vien-tuong'=>'',
                                    'tam-ly'=>'', 'tinh-cam'=>'', 'tai-lieu'=>'',
                                    'than-thoai'=>'', 'trinh-tham'=>'', 'gia-tuong'=>'', 'hoc-duong'=>'', 'phep-thuat'=>'', 'sieu-nhien'=>'', 'zombie' => ''
                                    );
                                foreach ($data as $type) {
                                    $film_type[$type] = 'checked';
                                }
                             ?>
                            <li><label><input type="checkbox" name="film_type[]" value="chien-tranh" {!! $film_type['chien-tranh'] !!}>Phim chiến tranh</label></li>
                            <li><label><input type="checkbox" name="film_type[]" value="co-trang" {!! $film_type['co-trang'] !!}>Phim cổ trang</label></li>
                            <li><label><input type="checkbox" name="film_type[]" value="gia-tuong" {!! $film_type['gia-tuong'] !!}>Phim giả tưởng</label></li>
                            <li><label><input type="checkbox" name="film_type[]" value="hai-huoc" {!! $film_type['hai-huoc'] !!}>Phim hài hước</label></li>
                            <li><label><input type="checkbox" name="film_type[]" value="hanh-dong" {!! $film_type['hanh-dong'] !!}>Phim hành động</label></li>
                            <li><label><input type="checkbox" name="film_type[]" value="hinh-sự" {!! $film_type['hinh-su'] !!}>Phim hình sự</label></label></li>
                            <li><label><input type="checkbox" name="film_type[]" value="hoc-duong" {!! $film_type['hoc-duong'] !!}>Phim học đường</label></li>
                            <li><label><input type="checkbox" name="film_type[]" value="kinh-di" {!! $film_type['kinh-di'] !!}>Phim kinh dị</label></label></li>
                            <li><label><input type="checkbox" name="film_type[]" value="hoi-hop-gay-can" {!! $film_type['hoi-hop-gay-can'] !!}>Phim hồi hộp gây cấn</label></label></li>
                            <li><label><input type="checkbox" name="film_type[]" value="phep-thuat" {!! $film_type['phep-thuat'] !!}>Phim phép thuật</label></li>
                            <li><label><input type="checkbox" name="film_type[]" value="phieu-luu" {!! $film_type['phieu-luu'] !!}>Phim phiêu lưu</label></label></li>
                            <li><label><input type="checkbox" name="film_type[]" value="sieu-nhien" {!! $film_type['sieu-nhien'] !!}>Phim siêu nhiên</label></li>
                            <li><label><input type="checkbox" name="film_type[]" value="tam-ly" {!! $film_type['tam-ly'] !!}>Phim tâm lý</label></label></li>
                            <li><label><input type="checkbox" name="film_type[]" value="tinh-cam" {!! $film_type['tinh-cam'] !!}>Phim tình cảm</label></li>
                            <li><label><input type="checkbox" name="film_type[]" value="tai-lieu" {!! $film_type['tai-lieu'] !!}>Phim tài liệu</label></li>
                            <li><label><input type="checkbox" name="film_type[]" value="than-thoai" {!! $film_type['than-thoai'] !!}>Phim thần thoại</label></li>
                            <li><label><input type="checkbox" name="film_type[]" value="trinh-tham" {!! $film_type['trinh-tham'] !!}>Phim trinh thám</label></li>
                            <li><label><input type="checkbox" name="film_type[]" value="vo-thuat" {!! $film_type['vo-thuat'] !!}>Phim võ thuật</label></label></li>
                            <li><label><input type="checkbox" name="film_type[]" value="vien-tuong" {!! $film_type['vien-tuong'] !!}>Phim viễn tưởng</label></label></li>
                            <li><label><input type="checkbox" name="film_type[]" value="zombie" {!! $film_type['zombie'] !!}>Phim Zombie</label></li>   
                            
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-10">
                <div class="form-group">
                    <label>Quốc Gia</label>
                    <div class="enter-data-ul">
                        <?php 
                            $data = explode(',', $film_detail->film_country);
                            $film_country = array('anh'=>'', 'an-do'=>'', 'au-my' => '',
                                                'dai-loan'=>'', 'han-quoc'=>'', 'hong-kong'=>'',
                                                'my'=>'', 'nga' => '', 'nhat-ban'=>'', 'viet-nam'=>'', 
                                                'thai-lan'=>'', 'trung-quoc'=>'',
                                                'quoc-gia-khac'=>''
                                                );
                            foreach ($data as $country) {
                                    $film_country[$country] = 'checked';
                                }
                         ?>
                        <ul>
                            <li><label><input type="checkbox" name="film_country[]" value="anh" {!! $film_country['anh'] !!}>Phim Anh</label></li>
                            <li><label><input type="checkbox" name="film_country[]" value="an-do" {!! $film_country['an-do'] !!}>Phim Ấn Độ</label></li>
                            <li><label><input type="checkbox" name="film_country[]" value="au-my" {!! $film_country['au-my'] !!}>Phim Âu-Mỹ</label></li>
                            <li><label><input type="checkbox" name="film_country[]" value="dai-loan" {!! $film_country['dai-loan'] !!}>Phim Đài Loan</label></li>
                            <li><label><input type="checkbox" name="film_country[]" value="han-quoc" {!! $film_country['han-quoc'] !!}>Phim Hàn Quốc</label></li>
                            <li><label><input type="checkbox" name="film_country[]" value="hong-kong" {!! $film_country['hong-kong'] !!}>Phim Hồng Kông</label></li>
                            <li><label><input type="checkbox" name="film_country[]" value="my"  {!! $film_country['my'] !!}>Phim Mỹ</li>
                            <li><label><input type="checkbox" name="film_country[]" value="nga" {!! $film_country['nga'] !!}>Phim Nga</label></li>
                            <li><label><input type="checkbox" name="film_country[]" value="nhat-ban" {!! $film_country['nhat-ban'] !!}>Phim Nhật</label></li>
                            <li><label><input type="checkbox" name="film_country[]" value="viet-nam" {!! $film_country['viet-nam'] !!}>Phim Việt Nam</label></li>
                            <li><label><input type="checkbox" name="film_country[]" value="thai-lan" {!! $film_country['thai-lan'] !!}>Phim Thái Lan</label></li>
                            <li><label><input type="checkbox" name="film_country[]" value="trung-quoc" {!! $film_country['trung-quoc'] !!}>Phim Trung Quốc</label></li>
                            <li><label><input type="checkbox" name="film_country[]" value="quoc-gia-khac" {!! $film_country['quoc-gia-khac'] !!}>Phim QG khác</label></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <!-- <div class="col-lg-6">
                <div class="form-group">
                    <label>Đạo Diễn:</label>
                    <span class="text-giai-thich"><i>Nếu có nhiều đạo diễn thì cách nhau bằng dấu phẩy và khoảng trắng ', '</i></span>
                    <span class="text-giai-thich"><i>Ex: Director 1, Director 2</i></span>
                    <textarea name="film_director" class="form-control" placeholder="Nhập tên đạo diễn" >{!! $film_detail->film_director !!}</textarea>
                </div>
            </div> -->
            <!-- <div class="col-lg-6">
                <div class="form-group">
                    <label>Diễn Viên:</label>
                    <span class="text-giai-thich"><i>Nếu có nhiều diễn viên thì cách nhau bằng dấu phẩy và khoảng trắng ', '</i></span>
                    <span class="text-giai-thich"><i>Ex: Actor 1, Actor 2</i></span>
                    <textarea name="film_actor" class="form-control" placeholder="Nhập tên diễn viên" >{!! $film_detail->film_actor !!}</textarea>
                </div>
            </div> -->
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Hãng Sản Xuất:</label>
                    <span class="text-giai-thich"><i>Nếu có nhiều cty sx thì cách nhau bằng dấu phẩy và khoảng trắng ', '</i></span>
                    <span class="text-giai-thich"><i>Ex: Company A, Company B</i></span>
                    <textarea name="film_production_company" class="form-control" placeholder="Nhập tên hãng sản xuất" >{!! $film_detail->film_production_company !!}</textarea>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Từ Khóa:</label>
                    <span class="text-giai-thich"><i>Nếu có nhiều từ khóa thì mỗi từ khóa được cách nhau bằng dấu phẩy và khoảng trắng ', '</i></span>
                    <span class="text-giai-thich"><i>Ex: Key word 1, key word 2</i></span>
                    <textarea name="film_key_words" class="form-control" placeholder="Nhập tên từ khóa" >{!! $film_detail->film_key_words !!}</textarea>
                </div>
            </div>
            <div class="form-group">
                <label>Phim Liên Quan:</label><br>
                <label><input type="checkbox" name="relate" value="no" checked="true"> Không cập nhật phim liên quan</label><br>
                <label>Id: {!! $film_detail->filmRelate->id !!}<textarea class="form-control" disabled="true">{!! $film_detail->filmRelate->film_relate_name !!}</textarea></label>
                
                <p><em>Không có phim liên quan</em></p>
                <div class="form-group">
                    <label><input type="checkbox" name="film_relate_no" value="1">Không có phim liên quan</label>
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
                            @foreach($directors as $director)
                            <li>
                                <input type="hidden" name="director_id[]" value="{!! $director->filmPerson->id !!}">
                                <span>{!! $director->filmPerson->person_name !!}</span>
                                <button type="button" class="btn btn-default btn-remove-director">Xóa</button>
                            </li>
                            @endforeach
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
                            @foreach ($actors as $actor)
                            <li>
                                <input type="hidden" name="actor_id[]" value="{!! $actor->filmPerson->id !!}">
                                <span>{!! $actor->filmPerson->person_name !!}</span>
                                <div class="col-sm-4 actor-character">
                                    <input type="text" class="form-control" name="actor_character[]" value="{!! $actor->actor_character !!}" placeholder="{!! $actor->filmPerson->person_name !!} trong vai">
                                </div>
                                <button type="button" class="btn btn-default btn-remove-actor">Xóa</button>
                            </li>
                            @endforeach
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
                <textarea name="film_thumbnail_small" class="form-control" placeholder="Nhập URL ảnh thumnail small" >{!! $film_list->film_thumbnail_small !!}</textarea>
            </div>
            <div class="form-group">
                <label>Ảnh Thumbnail big (450x600)</label>
                <textarea name="film_thumbnail_big" class="form-control" placeholder="Nhập URL ảnh thumnail big" >{!! $film_detail->film_thumbnail_big !!}</textarea>
            </div>
            <div class="form-group">
                <label>Ảnh Poster Video</label>
                <textarea name="film_poster_video" class="form-control" placeholder="Nhập URL ảnh poster video" >{!! $film_detail->film_poster_video !!}</textarea>
            </div>
            <div class="form-group">           
            <label>Trailer</label><br>
            <label>Nguồn Trailer: </label>
            <div>
                <select class="form-control" name="film_src_name">
                    <option value="youtube" @if($film_trailer->film_src_name == 'youtube') selected @endif>Youtube</option>
                    <option value="google photos" @if($film_trailer->film_src_name == 'google photos') selected @endif>Google Photos</option>
                    <option value="google drive" @if($film_trailer->film_src_name == 'google drive') selected @endif>Google Drive</option>
                </select>
            </div>
            <label>Source Trailer</label>
            <div>
                <textarea name="film_src_full" class="form-control" placeholder="Nhập URL trailer">{!! $film_trailer->film_src_full !!}</textarea>
            </div>
            <label>Ngôn Ngữ Trailer:</label>
            <div>
                <select name="film_episode_language" class="form-control">
                    <option value="vs" @if($film_trailer->film_episode_language == 'vs') selected @endif>VietSub</option>
                    <option value="tm" @if($film_trailer->film_episode_language == 'tm') selected @endif>Thuyết Minh</option>
                    <option value="lt" @if($film_trailer->film_episode_language == 'lt') selected @endif>Lồng Tiếng</option>
                    <option value="es" @if($film_trailer->film_episode_language == 'es') selected @endif>EnlishSub</option>
                    <option value="raw" @if($film_trailer->film_episode_language == 'raw') selected @endif>Raw</option>
                </select>
            </div>
          </div>
        </div>        
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Sửa Phim</button>
            <button type="reset" class="btn btn-default">Reset</button>
        </div>
        
    <form>
</div>
@include('admin.film.modal-add-film-person-director')
@include('admin.film.modal-add-film-person-actor')
@endsection
