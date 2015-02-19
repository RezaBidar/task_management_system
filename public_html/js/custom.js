$(document).ready(function(){
	
	
	$(".datatable").dataTable( {
		"info" : false ,
		"paging" : true ,
		"filter" :false
	});
	
	$("#user_list").multiselect();
	
	$(".datepicker").pDatepicker({
		timePicker : {
			enabled : true ,
		},
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
	
	$("#add_feedback").click(function(){
		var text = $.trim($('#feedback_text').val()) ;
		var type = 0 ;
		if($("#feedback_warning").is(':checked')) type = 1 ;
		if(text.length > 0){
			var url = $("input[name=addfeedback_url]").val();
			var wiw_id = $("input[name=wiw_id]").val();
			var task_id = $("input[name=task_id]").val();
			$.ajax({
				url : url ,
				method : "post" ,
				data: {
					text: text ,
					wiw_id : wiw_id ,
					task_id : task_id ,
					type : type ,
					},
				success : function(result){
					//bootbox.alert(text);
					location.reload();
					
				}
			});
		}else bootbox.alert("khalie") ;
	});
	
	
	$("#group_list").change(function(){
		
		var users_url =  $("input[name=users_url]").val() + '/' + $("#group_list option:selected").val();
		$("#user_list").multiselect('destroy');
		$("#user_list").html('') ;
		$.getJSON( users_url  , function( data ) {
			
//			bootbox.alert(data.toString()) ;
//			  var items = [];
			$.each( data, function( key, val ) {
				$("#user_list").append( "<option value='" + key + "'>" + val + "</option>" );
			});
			
			//$("#user_list").multiselect('rebulid'); //also can use rebuild
			$("#user_list").multiselect(); 

		});
	});
	
	$( ".star_rate" ).each(function( index ) {
		$(this).raty({
				hints       : ['بد','بد', 'ضعیف', 'ضعیف', 'متوسط', 'متوسط', 'خوب', 'خوب', 'عالی', 'عالی'], // Hints used on each star.
				scoreName   : 'duty_score[' + $(this).attr('id') + ']' ,
				number : 10 ,
				starOff : $("input[name=base_url]").val() + '/js/plugins/raty/images/star-off.png',
				starOn  : $("input[name=base_url]").val() + 'js/plugins/raty/images/star-on.png' ,
		});
	});
	
	$("#changetaskstatus").click(function(){
		var url = $("input[name=changestatus_url]").val();
		$.ajax({
			url : url ,
			method : "post" ,
			data: {
				status: 1 ,
				task_id :$("input[name=task_id]").val(),
				},
			success : function(result){
				//bootbox.alert(text);
				location.reload();
				
			}
		});
	});
	
	

});
