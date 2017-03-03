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
//autocomplete
$('.btn-search-ajax-film-relate').click(function() {
    //goi ajax
    var data = {
        //token
        _token : $('form.form-add-film').children('input[name="_token"]').val(),
        search_film_relate : $('.search-film-relate').val()
    };
    if(data['search_film_relate'] == ''){
        alert('Chưa nhập tên phim liên quan');
    }else{
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
    }
});


</script>