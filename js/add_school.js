$(document).ready(function () {
        
    $("#form_add_school").submit(function (e) {
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
       
       //var letters = /^[A-Z]+$/;  
        var upperCase = new RegExp('[A-ZΑ-Ω]');
                
        if (('#description').length > 0 && $('#description').val() !== "") {
            if (!($('#description').val().match(upperCase))) {
                errorFields.push("description");
            }
        }
        
        if (!($('#shname').val().match(upperCase))) {
            errorFields.push("shname");
        }
        
        if (!($('#location').val().match(upperCase))) {
            errorFields.push("location");
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





