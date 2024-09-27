$(document).ready(function () {
    
    //$("#runway").css({backgroundColor: 'blue'});
    
    $("#form_add_sart").submit(function (e) {
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

        //Check runway to be only numbers 
        var upperCase = new RegExp('[A-ZΑ-Ω0-9]');
        //var MyRunway = $('#runway').val();
        if (!($('#runway').val().match(upperCase))) {
        //if (!($.isNumeric(MyRunway))) {
            errorFields.push("runway");
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