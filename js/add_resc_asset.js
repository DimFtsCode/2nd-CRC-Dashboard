$(document).ready(function () {
    
    //$("#callsign").css({backgroundColor: 'blue'});
    
    $("#form_add_resc_asset").submit(function (e) {
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
        
        if (!($('#callsign').val().match(upperCase))) {
            //if (Mylast_name.length < 6){
            errorFields.push("callsign");
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