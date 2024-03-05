$(document).ready(function () {
    
    //$("#callsign").css({backgroundColor: 'blue'});
    
    $("#form_add_missions").submit(function (e) {
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

//        //Check IFF1 to be only numbers                
//        var MyIFF1 = $('#iff1').val();
//        if (!($.isNumeric(MyIFF1))) {
//            errorFields.push("iff1");
//        }


        //var letters = /^[A-Z]+$/;  
        var upperCase = new RegExp('[A-ZΑ-Ω0-9]');
        
        
        //var Mylast_name = $('#last_name').val();
        if (!($('#track').val().match(upperCase))) {
            //if (Mylast_name.length < 6){
            errorFields.push("track");
        }
        
        //var letters = /^[A-Z]+$/;          
        //var Mylast_name = $('#last_name').val();
        if (!($('#track2').val().match(upperCase))) {
            //if (Mylast_name.length < 6){
            errorFields.push("track2");
        }
        
        
        if (!($('#asset').val().match(upperCase))) {
            //if (Mylast_name.length < 6){
            errorFields.push("asset");
        }
        
        if (!($('#callsign').val().match(upperCase))) {
            //if (Mylast_name.length < 6){
            errorFields.push("callsign");
        }
               
//        if (('#office').length > 0 && $('#office').val() !== "") {
//            if (!($('#office').val().match(upperCase))) {
//                //if (Mylast_name.length < 6){
//                errorFields.push("office");
//            }
//        }
               
                         
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