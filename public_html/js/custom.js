$(document).ready(function(){
	
	
	$(".datatable").dataTable( {
		"info" : false ,
		"paging" : true ,
		"filter" :false
	});
	
	$("#datepicker3").datepicker({
        numberOfMonths: 3,
        showButtonPanel: true
    });

	$("#add_to_btn").click(function(){
		//bootbox.alert($( "#not_membered option:selected" ).val()) ;
		if($("#not_membered option:selected").length){
			var first_param = $("input[name=first_param]").val();
			var user_id = $( "#not_membered option:selected" ).val() ;
			var add_url = $("input[name=add_url]").val();
			$.ajax({
				url : add_url + "/" + first_param + "/" + user_id,
				success : function(result){
					location.reload();
				}
			});
		}
	});
	
	$("#remove_from_btn").click(function(){
		if($("#membered option:selected").length){
			var first_param = $("input[name=first_param]").val();
			var user_id = $( "#membered option:selected" ).val() ;
			var remove_url = $("input[name=remove_url]").val();
			$.ajax({
				url : remove_url + "/" + first_param + "/" + user_id,
				success : function(result){
					location.reload();
				}
			});
		}
	});
	
	
});
