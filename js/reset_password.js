$(document).ready(function () {
    
    //$("#password2").css({backgroundColor: 'yellow'});
    
    $("#form_reset_password").submit(function (e) {
        removeFeedback();
        var errors = validateForm(); 
        if (errors == "") {
            return true;
        } else {
            provideFeedback(errors);
            e.preventDefault();
            return false;
        }
    }
    );
               
    
    function validateForm() {
        var errorFields = new Array();

        //Check asma to be only numbers                
        var MyAsma = $('#asma').val();
        if (!($.isNumeric(MyAsma))) {
            errorFields.push("asma");
        }
        
        //Check idnumber to be only numbers                
        var MyIDnum = $('#idnumber').val();
        if (!($.isNumeric(MyIDnum))) {
            errorFields.push("idnumber");
        }
        
        
        var MyPassword= $('#password').val();
         if (MyPassword.length < 7) {
         //if (!($.isNumeric(MyPassword))) {    
            errorFields.push("password");
        }
        
        var MyPassword2= $('#password2').val();
         if (MyPassword2.length < 7) {
         //if (!($.isNumeric(MyPassword))) {    
            errorFields.push("password2");  
        } 
        
         // Check passwords match
        if ($('#password2').val() != $('#password').val()) {
        errorFields.push('password2');
         }         
                     
        return errorFields;
    } //end function validateForm


    function provideFeedback(incomingErrors) {
        for (var i = 0; i < incomingErrors.length; i++)
        {
            $("#" + incomingErrors[i]).
                    addClass("errorClass");
            $("#" + incomingErrors[i] + "Error").removeClass("errorFeedback");
        }
        $("#errorDiv").html("Errors encountered");
    } //end function provideFeedback

    function removeFeedback() {
        $("#errorDiv").html("");
        $('input').each(function () {
            $(this).removeClass("errorClass");
        });
        $('.errorSpan').each(function () {
            $(this).addClass("errorFeedback");
        });
    }

});            