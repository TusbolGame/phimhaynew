@extends('admin.master')
@section('header')
<div class="col-lg-12">
    <h1 class="page-header">User
        <small>Search</small>
    </h1>
</div>
@endsection
@section('content')
<div class="col-lg-7" style="padding-bottom:120px">
    <form action="#" method="POST" class="form-search-user">
        @include('admin.messages.messages')
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <div class="form-group">
            <label>Tìm kiếm user:</label>
            <input class="form-control" id="search-key-value" name="txtUsername" value="{{ old('txtUsername') }}" placeholder="Please Enter Username or Full name" required="true" />
        </div>
    <form>
    <div class="user-search-result">
        <h4>Kết quả:
        <ul>
            <li>
                <!-- <a href="" title="">
                    <img src="" width="50px" height="50px" alt="">
                    <span>Usss</span><span> - </span><span>Usss</span>
                </a> -->
            </li>
        </ul>
    </div>
</div>
<script>
function showSearchResult() {
    $('.user-search-result').show();
}
function addSearchUser($dir, $image, $username, $full_name) {
    $user_search = '<li><a href="'+$dir+'" title="User '+$username+'">'+
                    '<img src="'+$image+'" width="50px" height="50px" alt="Error image user">'+
                    '<span>'+$username+'</span><span> - </span><span>'+$full_name+'</span>'+
                '</a></li>';
    $('.user-search-result ul').append($user_search);
}
function removeSearchUser() {
    $('.user-search-result ul li').remove();
}
//khi click vao khoi tao keyup
$('input#search-key-value').click(function() {
    $(this).keyup(function() {
        //goi ajax
        var data = {
            _token : $('form.form-search-user').children('input[name="_token"]').val(),
            search_key_value : $('input#search-key-value').val()
        };
        $.ajax({
            type : 'POST',
            dataType : 'json',
            url : '{!! route('admin.userAjax.postSearch') !!}',
            data : data,
            success : function (result){
                //call remove
                removeSearchUser();
                if(result != null){
                    var dk = result.length;
                    var i = 0;
                    while(i < dk){
                        addSearchUser('{!! env('WEBSITE_NAME') !!}admin/user/edit/'+result[i]['id'], '{!! env('WEBSITE_NAME') !!}resources/photos/'+result[i]['image'], result[i]['username'], result[i]['first_name']+' '+result[i]['last_name']);                     
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
