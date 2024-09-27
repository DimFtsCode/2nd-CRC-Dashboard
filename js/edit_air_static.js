$(document).ready(function () {
    
    
    //$("#btn_delete").attr("disabled", true);
    //$("#gr_ramrod").css({backgroundColor: 'blue'});
    
    //$("#sunrise").setMask('time').val('hh:mm');
    //$("#sunset").setMask('time').val('hh:mm');
    
    $("#form_edit_air_static").submit(function (e) {  
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
        var GRRAM = $('#gr_ramrod').val();
        //if (!($('#gr_ramrod').val().match(upperCase))) {  
        if (!GRRAM.match(upperCase)) {    
            errorFields.push("gr_ramrod");
        }
        
        if (!($('#c').val().match(upperCase))) {            
            errorFields.push("nato_ramrod");
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