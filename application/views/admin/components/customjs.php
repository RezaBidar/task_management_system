$(document).ready(function () {      
    $('#category tbody tr').click(function (event) {
         window.location = "<?php echo site_url('admin/question/index')?>/" + $(this).attr('id') ;
    });
    
    $('#sample_question_checkbox').change(function(){
    	if($(this).is(':checked')){
    		$('#sample_question_form').fadeIn();
    	}else{
    		$('#sample_question_form').fadeOut();
    	}
    	
    });
});