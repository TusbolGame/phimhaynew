$(document).ready(function() {
    $('#dataTables-example').DataTable({
            responsive: true
    });
    //hien popup message 3s
	//$('.result-message').delay(3000).slideUp();

	//show - hide edit password user
	$('.chkEditPassword').click(function() {
		$edit_password = $('.edit-password');
		if($(this).prop('checked') == true){
			//is checked
			//show div edit password
			
			if($edit_password.hasClass('hide')){
				$edit_password.removeClass('hide');
			}
			$('.edit-password').addClass('show');
		}else{
			//hide
			if($edit_password.hasClass('show')){
				$edit_password.removeClass('show');
			}
			$('.edit-password').addClass('hide');
		}
	});

});
function checkDelete(message) {
		var check = confirm(message);
		if(check == true){
			return true;
		}
		return false;
	}
