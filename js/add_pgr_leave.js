$(document).ready(function () {
    
    //$("#location").css({backgroundColor: 'blue'});
    //$("#asma").val(12345);
    //$("#asma").val($user->asma);
    
    $("#form_add_pgr_leave").submit(function (e) {
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
        //var Mylast_name = $('#last_name').val();
        if (!($('#location').val().match(upperCase))) {
            //if (Mylast_name.length < 6){
            errorFields.push("location");
        }
        
        var MyLocation= $('#location').val();
         if (MyLocation.length < 4) {
         //if (!($.isNumeric(MyPassword))) {    
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


