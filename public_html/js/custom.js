$(document).ready(function(){
	$("#testform_add_id").click(function(){
		bootbox.dialog({
	            title: "This is a form in a modal.",
	            message: '<div class="row">  ' +
	                '<div class="col-md-12"> ' +
	                '<form class="form-horizontal"> ' +
	                '<div class="form-group"> ' +
	                '<label class="col-md-4 control-label" for="name">Name</label> ' +
	                '<div class="col-md-4"> ' +
	                '<input id="name" name="name" type="text" placeholder="Your name" class="form-control input-md"> ' +
	                '<span class="help-block">Here goes your name</span> </div> ' +
	                '</div> ' +
	                '<div class="form-group"> ' +
	                '<label class="col-md-4 control-label" for="awesomeness">How awesome is this?</label> ' +
	                '<div class="col-md-4"> <div class="radio"> <label for="awesomeness-0"> ' +
	                '<input type="radio" name="awesomeness" id="awesomeness-0" value="Really awesome" checked="checked"> ' +
	                'Really awesome </label> ' +
	                '</div><div class="radio"> <label for="awesomeness-1"> ' +
	                '<input type="radio" name="awesomeness" id="awesomeness-1" value="Super awesome"> Super awesome </label> ' +
	                '</div> ' +
	                '</div> </div>' +
	                '</form> </div>  </div>',
	            buttons: {
	                success: {
	                    label: "Save",
	                    className: "btn-success",
	                    callback: function () {
	                        var name = $('#name').val();
	                        var addarea = document.getElementById("testform_makan");
	                		
	                		var btn = document.createElement("button");
	                		btn.innerHTML = name;
	                		//btn.val = name ;
	                		btn.setAttribute("class", "btn btn-primary btn-xs remove-to-click") ;
	                		btn.setAttribute("id" , name);
	                		btn.setAttribute("onClick" , "remove()");
	                		
	                		addarea.appendChild(btn);
	                    }
	                }
	            }
	        }
	    );
		
	});
	
	$(".datatable").dataTable( {
		"info" : false ,
		"paging" : true ,
		"filter" :false
	});
	
//	$(".deleteRow").click(function(){
//		confirm("are you ok ?");
//	});
//	 $('.datatable tbody tr').click(function (event) {
//		 bootbox.alert($(this).attr('id'));
//	 });
	
	
});
