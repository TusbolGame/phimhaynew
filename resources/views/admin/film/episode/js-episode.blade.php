<script>
//edit
$('.show-select-track').click(function(){
  $track = $('.track-edit');
  if($(this).is(':checked')){
      $track.removeClass('hidden');
      $track.addClass('show');
  }else{
      $track.removeClass('show');
      $track.addClass('hidden');
  }
  
});
//end edit
  $('.select-film-src-name').click(function(){
    //
    $local = $('.select-source-local');
      if($(this).val() == 'local'){
        $local.removeClass('hidden');
      }else{
        $local.addClass('hidden');
      }
      
  })
  $('.file-upload-info').hide();
  //load
  //
  var token = $('form').find('input[name="_token"]').val();
  //
  $('.file-select-video-upload').change(function() {
    if($(this)[0].files[0]){
      //show
      showFileUploadProgress($(this));
      $file_name = $(this).val().split('\\').pop();
      console.log($(this).val().split('\\').pop());
      $(this).parent().find('.file-upload-name').html($file_name);
      showFileUploadProgress($(this));
      $(this).parent().find('.file-upload-size').html(parseInt(parseInt($(this)[0].files[0].size)/(1024*1024))+'MB');
      $upload_result = $(this).parent().find('.file-upload-result');
      if(!checkExistsFileUpload($file_name)){
        uploadFile($(this)[0].files[0], $(this));
      }else{
        $upload_result.children('.file-upload-result-error').html('Lỗi File đã tồn tại.');
      }
    }
  });
  //click
  function uploadFile($file_upload, $this){
    var xhr = new window.XMLHttpRequest();
      var file = $file_upload;
      var form_data = new FormData();
      form_data.append('_token', token);
      form_data.append('file', file);
      var progress = $this.parent().find('.progress-bar');
      // 
      $upload_result.children('.file-upload-result-success').html('Loading..........');
      // console.log(progress.html());
      // return false;
      $.ajax({
        xhr: function() {
          xhr.upload.addEventListener("progress", function(evt) {
            if (evt.lengthComputable) {
              var percentComplete = evt.loaded / evt.total;
              percentComplete = parseInt(percentComplete * 100);
              // console.log(percentComplete);
              progress.attr({
                'aria-valuenow': percentComplete
              });
              progress.width(percentComplete+'%');
              progress.html(percentComplete+'%');
              if (percentComplete === 100) {
                console.log('success');
              }

            }
          }, false);

          return xhr;
        },
        type: 'POST',
        url: '{!! route('admin.film.episodeAjax.postUpload') !!}',
        data: form_data,
        async: true, //show console
        processData: false,
        contentType: false,
        success: function(result) {
          if(result['status'] == 1){
            $upload_result.children('.file-upload-result-success').html('Hoàn thành');
            //add even delete
            //set add src
            setFileSourceUpload($this, $file_name)
            deleleUpload($this);
          }else{
            $upload_result.children('.file-upload-result-success').html('');
            $upload_result.children('.file-upload-result-error').html(result['content']);
          }
        }
      });
      //cancel
      $this.parent().find('.btn-upload-file-cancel').on('click', function(e){ 
        // console.log('aa')     ;
        xhr.abort();
      });
  }
  function showFileUploadProgress($this){
    //
    $this.parent().children('.file-upload-info').show();
  }
  function hideFileUploadProgress($this){
    $this.parent().children('.file-upload-info').hide();
  }
  function checkExistsFileUpload($file_name){
    var data = {
      _token: token,
      file_name: $file_name
    }
    $.ajax({
      type: 'POST',
      dataType : 'json',
      url: '{!! route('admin.film.episodeAjax.postCheckExists') !!}',
      data: data,
      async: true, //show console
      success: function(result) {
        if(result['status'] == 1){
          return true;
        }else{
          return false;
        }
      }
    });
    return false;
  }
  function deleleUpload($this){
    $this.parent().find('.btn-upload-file-delete').on('click', function(e){
      var data = {
        _token: token,
        file_name: $file_name
      }
      $.ajax({
        type: 'POST',
        dataType : 'json',
        url: '{!! route('admin.film.episodeAjax.postDelete') !!}',
        data: data,
        async: true, //show console
        success: function(result) {
          if(result['status'] == 1){
            reserFileUpload($this);
            setFileSourceUpload($this)
          }
        }
      });
    });
  }
  function reserFileUpload($this){
    $parent = $this.parent();
    //hide
    hideFileUploadProgress($this);
    //
    $this.val('');
    $parent.find('.file-upload-name').html('');
    $parent.find('.file-upload-size').html('');
    $parent.find('.progress-bar').html('0%');
    $parent.find('.progress-bar').attr('aria-valuenow', 0);
    $parent.find('.progress-bar').width('0%');
    $parent.find('.file-upload-result').children('.file-upload-result-success').html('');
    $parent.find('.file-upload-result').children('.file-upload-result-error').html('');
  }
  function setFileSourceUpload($this, $name = ''){
    $this.parent().find('.file_src_upload').val($name);
  }
  
</script>