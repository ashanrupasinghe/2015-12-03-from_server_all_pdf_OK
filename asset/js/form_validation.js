$().ready(function(){
   
    $.validator.addMethod("pattern", function(value, element) {
        return this.optional(element) || /^[0-9]{9}[vVxX]$/.test(value);
    });


$('#myform').validate({
    rules : {
        suspect_name : {
              required : true
        },
        nic: {
              required : true,
              pattern: true
         
        }
    },
    messages : {
        nic: {
            required: "Field is empty",
            pattern : "NIC not valid"
            
        }
        
    }
    
    
});

$('#login_form').validate({
    rules : {
        username : {
              required : true
        },
        password: {
              required : true
        }
    },
    messages : {
        username: {
            required: "Field is empty"     
        },
        password: {
            required: "Field is empty"     
        }
        
    }
    
    
});


function validate()
{
	/*alert("dfdf");*/
//	$('#myform').validate({
//	    rules : {
//	        suspect_name : {
//	              required : true
//	        },
//	        nic: {
//	              required : true,
//	              pattern: true
//	         
//	        }
//	    },
//	    messages : {
//	        nic: {
//	            required: "Field is empty",
//	            pattern : "NIC not valid"
//	            
//	        }
//	        
//	    }
//	    
//	    
//	});

}

});