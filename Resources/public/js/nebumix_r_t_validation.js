	/*function check_field(name_form, name_field){
		var res = "";

		$.ajax({  
	        url: Routing.generate('nebumixrt_validation_check'),  
	        type: "POST",  
	        async: false,
	        data: { item : $('#form_'+name_field).val(), name : name_field, nameForm : name_form },
	        dataType: "html",
	        success: function(msg) { 
	              //alert(msg);
	              res = msg;
	              
	              if(msg != 1){
	              	$('#'+name_field+'_error').html(msg);
	              }else{
	              	$('#'+name_field+'_error').html("");
	              }
	        },
	        error: function(){
	          alert("ERROR!");
	        } 
	      }); 	

	      return res;			
	}*/


	function check_field(name_form, name_field){
		var res = "";

		$.ajax({  
	        url: Routing.generate('nebumixrt_validation_check'),  
	        type: "POST",  
	        async: false,
		data: { item : $('#'+name_field+'').val(), name : name_field, nameForm : name_form },
	        dataType: "html",
	        success: function(msg) { 
	              //alert(msg);
	              res = msg;
	              
	              if(msg != 1){
	              	$('#'+name_field+'_error').html(msg);
	              }else{
	              	$('#'+name_field+'_error').html("");
	              }
	        },
	        error: function(){
	          alert("ERROR!");
	        } 
	      }); 	

	      return res;			
	}


	function check_field_check(name_form, name_field){
		var res = "";

		$.ajax({  
	        url: Routing.generate('nebumixrt_validation_check'),  
	        type: "POST",  
	        async: false,
		data: { item : $( 'input:radio[name*='+name_field+']:checked' ).val(), name : name_field, nameForm : name_form },
	        dataType: "html",
	        success: function(msg) { 
	              //alert(msg);
	              res = msg;

	              if(msg != 1){
	              	$('#'+name_field+'_error').html(msg);
	              }else{
	              	$('#'+name_field+'_error').html("");
	              }
	        },
	        error: function(){
	          alert("ERROR!");
	        } 
	      }); 	

	      return res;			
	}
