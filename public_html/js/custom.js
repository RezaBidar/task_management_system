$(document).ready(function(){
	
	
	$(".datatable").dataTable( {
		"info" : false ,
		"paging" : true ,
		"filter" :false
	});

	$("#add_to_group_btn").click(function(){
		//bootbox.alert($( "#not_membered option:selected" ).val()) ;
		if($("#not_membered option:selected").length){
			var group_id = $("input[name=group_id]").val();
			var user_id = $( "#not_membered option:selected" ).val() ;
			var base_url = $("input[name=base_url]").val();
			$.ajax({
				url : base_url + "admin/dash_group/add_to_group/" + group_id + "/" + user_id,
				success : function(result){
					location.reload();
				}
			});
		}
	});
	
	$("#remove_from_group_btn").click(function(){
		if($("#membered option:selected").length){
			var group_id = $("input[name=group_id]").val();
			var user_id = $( "#membered option:selected" ).val() ;
			var base_url = $("input[name=base_url]").val();
			$.ajax({
				url : base_url + "admin/dash_group/delete_from_group/" + group_id + "/" + user_id,
				success : function(result){
					location.reload();
				}
			});
		}
	});
	
	
});
