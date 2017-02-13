<div class="modal fade modal-add-film-person-actor" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="gridSystemModalLabel">Thêm Diễn Viên</h4>
      </div>
      <div class="modal-body">
        <form action="" class="form-add-film-person-actor" method="post" accept-charset="utf-8">
          <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            <div class="form-group">
              <label>Tên diễn viên</label>
              <input type="text" class="form-control actor_name" name="actor_name" placeholder="Nhập tên diễn viên" value="">
            </div>
            <div class="form-group">
              <label>Tên diễn viên (đầy đủ)</label>
              <input type="text" class="form-control actor_full_name" name="actor_full_name" placeholder="Nhập tên diễn viên (đầy đủ)" value="">
            </div>
            <div class="form-group">
              <label>Tên khai sinh</label>
              <input type="text" class="form-control actor_birth_name" name="actor_birth_name" placeholder="Nhập tên khai sinh" value="">
            </div>
            <div class="form-group">
              <label>Tên biệt hiệu</label>
              <input type="text" class="form-control actor_nick_name" name="actor_nick_name" placeholder="Nhập tên biệt hiệu" value="">
            </div>
            <div class="form-group">
              <label>Ngày sinh, địa điểm</label>
              <textarea class="form-control actor_birth_date" name="actor_birth_date" class="Nhập ngày sinh, địa điểm"></textarea>
            </div>
            <div class="form-group">
              <label>Giới tính:</label>
              <label>Nam<input type="radio" name="actor_sex" class="actor_sex" value="Nam"></label>
              <label>Nữ<input type="radio" name="actor_sex" class="actor_sex" value="Nữ"></label>
              <br>
            </div>
            <div class="form-group">
             <label>Nghề nghiệp:</label>
              <select name="actor_job[]" class="form-control actor_job" required="true" multiple>
                @foreach ($film_job as $job)
                  @if ($job->id == 2)
                    <option value="{!! $job->id !!}" selected="true">{!! $job->job_name !!}</option>
                  @else
                    <option value="{!! $job->id !!}">{!! $job->job_name !!}</option>
                  @endif
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label>Chiều cao</label>
              <input type="text" class="form-control actor_height" name="actor_height" placeholder="Nhập chiều cao" value="">
            </div>
            <div class="form-group">
              <label>Thông tin</label>
              <textarea class="form-control actor_info" name="actor_info" placeholder="Nhập thông tin"></textarea>
            </div>
            <div class="form-group">
              <label>Ảnh đại diện</label>
              <textarea class="form-control actor_image" name="actor_image" placeholder="Nhập đường dẫn ảnh"></textarea>
            </div>
            <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
            <button type="button" class="btn btn-primary add-film-person-actor">Thêm Diễn viên</button>
            <p class="film-actor-result bg-danger" style="margin-top: 10px;"></p>
        </form>
      </div>
      <div class="modal-footer">
        
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
                $('.show-film-person-director').click(function() {
                    $('.modal-add-film-person-director').modal('show');
                });
                $('.show-film-person-actor').click(function() {
                    $('.modal-add-film-person-actor').modal('show');
                });
                //remove director
                $('body').on('click', '.btn-remove-director', function() {
                    $(this).parent('li').remove();
                });
                //remove actor
                $('body').on('click', '.btn-remove-actor', function() {
                    $(this).parent('li').remove();
                });
                //add director
                $('body').on('click', '.btn-add-director', function() {
                    $result_li = $(this).parent('li');
                    $director_id = $result_li.children('input').val();
                    $director_name = $result_li.children('span').text();
                    addDirector($director_id, $director_name);
                    $result_li.remove();
                });
                //add actor
                $('body').on('click', '.btn-add-actor', function() {
                    $result_li = $(this).parent('li');
                    $director_id = $result_li.children('input').val();
                    $director_name = $result_li.children('span').text();
                    addActor($director_id, $director_name);
                    //remove chinh no
                    $result_li.remove();
                });
                //ajax post director
                $('.add-film-person-director').click(function() {
                    //job
                    $job = new Array();
                    $('.director_job option:selected').each(function() {
                        $job.push($(this).val());
                    });
                    // console.log($job);
                    //goi ajax
                    var data = {
                        //token
                        _token : $('form.form-add-film').children('input[name="_token"]').val(),
                        person_name : $('.director_name').val(),
                        person_full_name : $('.director_full_name').val(),
                        person_birth_name : $('.director_birth_name').val(),
                        person_nick_name : $('.director_nick_name').val(),
                        person_birth_date : $('.director_birth_date').val(),
                        person_sex : $('.director_sex:checked') ? $('.director_sex:checked').val() : '',
                        person_height : $('.director_height').val(),
                        person_job : $job,
                        person_info : $('.director_info').val(),
                        person_image : $('.director_image').val()
                    };
                    $.ajax({
                        type : 'POST',
                        dataType : 'json',
                        url : '{!! route('admin.filmPersonAjax.postAdd') !!}',
                        data : data,
                        success : function (result){
                            //
                            if(result['status'] != 1){
                                var kq = $('.film-director-result');
                                kq.text(result['content']);
                            }
                            //
                            else if(result['status'] == 1){
                                //hide modal
                                $('.modal-add-film-person-director').modal('hide');
                                //add director to form
                                addDirector(result['content']['id'], result['content']['person_name']);
                            }
                        },
                        error : function (){
                            console.log('Lỗi xử lý đường truyền');
                        }
                    });
                        

                });
                //ajax post actor
                $('.add-film-person-actor').click(function() {
                    //job
                    $job = new Array();
                    $('.actor_job option:selected').each(function() {
                        $job.push($(this).val());
                    });
                    //goi ajax
                    var data = {
                        //token
                        _token : $('form.form-add-film').children('input[name="_token"]').val(),
                        person_name : $('.actor_name').val(),
                        person_full_name : $('.actor_full_name').val(),
                        person_birth_name : $('.actor_birth_name').val(),
                        person_nick_name : $('.ator_nick_name').val(),
                        person_birth_date : $('.ator_birth_date').val(),
                        person_sex : $('.actor_sex:checked') ? $('.actor_sex:checked').val() : '',
                        person_height : $('.actor_height').val(),
                        person_job : $job,
                        person_info : $('.actor_info').val(),
                        person_image : $('.actor_image').val()
                    };
                    $.ajax({
                        type : 'POST',
                        dataType : 'json',
                        url : '{!! route('admin.filmPersonAjax.postAdd') !!}',
                        data : data,
                        success : function (result){
                            //
                            if(result['status'] != 1){
                                var kq = $('.film-actor-result');
                                kq.text(result['content']);
                            }
                            //
                            else if(result['status'] == 1){
                                //hide modal
                                $('.modal-add-film-person-actor').modal('hide');
                                //add actor to form
                                addActor(result['content']['id'], result['content']['person_name']);
                            }
                        },
                        error : function (){
                            console.log('Lỗi xử lý đường truyền');
                        }
                    });
                });
                function addDirector($director_id, $director_name){
                    $content = '<li>'+
                            '<input type="hidden" name="director_id[]" value="'+$director_id+'">'+
                            '<span>'+$director_name+'</span>'+
                            '<button type="button" class="btn btn-default btn-remove-director">Xóa</button></li>';
                    $('.director-list ol').append($content);
                }
                function addActor($director_id, $director_name){
                    $content = '<li>'+
                            '<input type="hidden" name="actor_id[]" value="'+$director_id+'">'+
                            '<span>'+$director_name+'</span>'+
                            '<div class="col-sm-4 actor-character">'+
                                    '<input type="text" class="form-control" name="actor_character[]" value="" placeholder="'+$director_name+' trong vai">'+
                                '</div>'+
                            '<button type="button" class="btn btn-default btn-remove-director">Xóa</button></li>';
                    $('.actor-list ol').append($content);
                }
                function addSearchResultDirector($director_id, $director_name){
                    $content = '<li>'+
                                '<input type="hidden" name="search-result-director-id" value="'+$director_id+'" disabled="true">'+
                                '<span class="search-result-director-name">'+$director_name+'</span>'+
                                '<button type="button" class="btn btn-default btn-add-director">Thêm</button>'+
                            '</li>';
                    $('.search-result-film-director ol').append($content);
                }
                function addSearchResultActor($director_id, $director_name){
                    $content = '<li>'+
                                '<input type="hidden" name="search-result-actor-id" value="'+$director_id+'" disabled="true">'+
                                '<span class="search-result-actor-name">'+$director_name+'</span>'+
                                '<button type="button" class="btn btn-default btn-add-actor">Thêm</button>'+
                            '</li>';
                    $('.search-result-film-actor ol').append($content);
                }
                function removeSearchResultDirector(){
                    $('.search-result-film-director ol li').remove();
                }
                function removeSearchResultActor(){
                    $('.search-result-film-actor ol li').remove();
                }
                //ajax search director
                $('.search-film-director').click(function() {
                        //autocomplete
                        $(this).keyup(function() {
                            //goi ajax
                            var data = {
                                //token
                                _token : $('form.form-add-film').children('input[name="_token"]').val(),
                                search_film_director : $('.search-film-director').val()
                            };
                            $.ajax({
                                type : 'POST',
                                dataType : 'json',
                                url : '{!! route('admin.filmPersonAjax.postSearch') !!}',
                                data : data,
                                success : function (result){
                                    if(result['status'] != 0){
                                        var dk = result['content'].length;
                                        var i = 0;
                                        //remove result
                                        removeSearchResultDirector();
                                        while(i < dk){  
                                            //add
                                            addSearchResultDirector(result['content'][i]['id'], result['content'][i]['person_name']);                     
                                            i++;
                                        }
                                    }

                                },
                                error : function (){
                                    console.log('Lỗi xử lý đường truyền');
                                }
                            });
                        });

                    });
                //ajax search actor
                $('.search-film-actor').click(function() {
                        //autocomplete
                        $(this).keyup(function() {
                            //goi ajax
                            var data = {
                                //token
                                _token : $('form.form-add-film').children('input[name="_token"]').val(),
                                search_film_director : $('.search-film-actor').val()
                            };
                            $.ajax({
                                type : 'POST',
                                dataType : 'json',
                                url : '{!! route('admin.filmPersonAjax.postSearch') !!}',
                                data : data,
                                success : function (result){
                                    if(result['status'] != 0){
                                        var dk = result['content'].length;
                                        var i = 0;
                                        //remove result
                                        removeSearchResultActor();
                                        while(i < dk){  
                                            //add
                                            addSearchResultActor(result['content'][i]['id'], result['content'][i]['person_name']);                     
                                            i++;
                                        }
                                    }

                                },
                                error : function (){
                                    console.log('Lỗi xử lý đường truyền');
                                }
                            });
                        });

                    });
            </script>