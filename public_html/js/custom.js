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
	
	$("#group_list").change(function(){
		
		var users_url =  $("input[name=users_url]").val() + '/' + $("#group_list option:selected").val();
		$("#user_list").html('') ;
		$.getJSON( users_url  , function( data ) {
			
//			bootbox.alert(data.toString()) ;
//			  var items = [];
			$.each( data, function( key, val ) {
				$("#user_list").append( "<option value='" + key + "'>" + val + "</option>" );
			});
			 
//			  $( "<select/>", {
//			    "class": "my-new-list",
//			    html: items.join( "" )
//			  }).appendTo( "body" );
		});
	});
});
