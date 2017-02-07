@extends('admin.master')
@section('header')
<div class="col-lg-12">
    <h1 class="page-header bg-primary">Film
        <small>Search</small>
    </h1>
</div>
@endsection
@section('content')
<div class="col-lg-12">
    <h3>Tìm kiếm phim</h3>
    <form action="#" class="form-search-film" method="get" accept-charset="utf-8">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <div class="form-group col-sm-6">
            <input type="text" id="search-key-value" class="form-control" placeholder="Tìm kiếm phim">
            <div class="search-result search-result-admin">
                <div class="search-title">
                    <span>Tìm kiếm với "</span>
                    <span class="search-key-word text-danger"></span>
                    <span>":</span>
                    <span class="search-icon-close glyphicon glyphicon-remove" title="Đóng"></span>
                </div>
                <ul>
                    <!-- <li>
                        <a href="#" title="">
                            <div class="search-poster-film"><img src="{!! url('resources/poster/poster-lost-1.jpg') !!}" alt="Error image poster film"></div>
                            <span class="search-name-film">Tên phim</span>
                            <span class="search-name-film">Tên phim</span>
                            <span class="search-year-film">Nam</span>
                            <div class="clearfix"></div>
                        </a>
                    </li> -->
                </ul>
            </div>
        </div>
        
    </form>
    
     
</div>
<script>
$('.film-btn-search').click(function() {
    $key = $('input#search-key-value').val();
    $film_url = '{!! route('film.getSearch') !!}';
    window.location.href = $film_url+'?name='+$key;
});
    //search
$('.search-icon-close').click(function() {
    $('.search-result').hide();
    //se remove all li of ul
    $('.search-result ul li').remove();
});
function showSearchResult() {
    $('.search-result').show();
}
function addSearchFilm($film_dir, $film_img, $film_name_full, $film_name_vn, $film_name_en, $film_year) {
    $film_search = '<li>'+
                            '<a href="'+$film_dir+'">'+
                                '<div class="search-poster-film"><img src="'+$film_img+'" alt="Error image poster film"></div>'+
                                '<span class="search-name-film">'+$film_name_vn+'</span>'+
                                '<span class="search-name-film">'+$film_name_en+'</span>'+
                                '<span class="search-year-film">'+$film_year+'</span>'+
                                '<div class="clearfix"></div>'+
                            '</a>'+
                        '</li>';
    $('.search-result ul').append($film_search);
}
function removeSearchFilm() {
    $('.search-result ul li').remove();
}
//khi click vao khoi tao keyup
$('input#search-key-value').click(function() {
    $(this).keyup(function() {
        //goi ajax
        var data = {
            _token : $('form.form-search-film').children('input[name="_token"]').val(),
            search_key_value : $('input#search-key-value').val()
        };
        $.ajax({
            type : 'POST',
            dataType : 'json',
            url : '{!! route('filmAjax.getSearchFilm') !!}',
            data : data,
            success : function (result){
                //goi remove
                removeSearchFilm();
                $('.search-key-word').text(data['search_key_value']);
                if(result != null){
                    var dk = result.length;
                    var i = 0;
                    while(i < dk){
                        $name_film = result[i]['film_name_vn']+'-'+result[i]['film_name_en'];
                        if(result[i]['film_name_vn'] == ''){
                            $name_film = result[i]['film_name_en'];
                        }
                        if(result[i]['film_name_en'] == ''){
                            $name_film = result[i]['film_name_vn']
                        }
                        addSearchFilm('{!! env('WEBSITE_NAME') !!}admin/film/show/'+result[i]['id'], result[i]['film_thumbnail_small'], $name_film, result[i]['film_name_vn'], result[i]['film_name_en'], result[i]['film_years']);                     
                        i++;
                    }
                    //show
                    showSearchResult();
                }

            },
            error : function (){
                console.log('Lỗi xử lý đường truyền');
            }
        });
    });
});
</script>
@endsection
