$(document).ready(function () {
    $("#userForm").submit(function (e) {
        alert("you are here!");
        var errors = validateForm();
        removeFeedback();
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
        //Check required fields have something in them
        if ($('#name').val() == "") {
            errorFields.push('name');
        }
        if ($('#email').val() == "") {
            errorFields.push('email');
        }
        if ($('#password1').val() == "") {
            errorFields.push('password1');
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
        $("#errorDiv").html("test");
        $('input').each(function () {
            $(this).removeClass("errorClass");
        });
        $('.errorSpan').each(function () {
            $(this).addClass("errorFeedback");
        });
    }
});