$(document).ready(function()
{ 
	 //nivo
	$('#slider').nivoSlider({
	    effect:'fold', //Specify sets like: 'fold,fade,sliceDown'
	    slices: 8,
	    directionNav:true, //Next & Prev
	    directionNavHide:true, //Only show on hover
	    controlNav:true, //1,2,3...
	    keyboardNav:true, //Use left & right arrows
	});
});