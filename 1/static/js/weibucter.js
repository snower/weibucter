// JavaScript Document
$(".example_image").click(function(){
	if($(this).data("big_size")){
		$(this).removeClass("span4").addClass("span2").data("big_size",false);
	}
	else{
		$(this).removeClass("span2").addClass("span4").data("big_size",true);
	}
});