$(document).ready(function () {
    
    //$("#callsign").css({backgroundColor: 'blue'});
    
    $("#form_add_logbook").submit(function (e) {
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
    
        $("#set_time").click(function () {
        var dt = new Date();
        var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
        //alert(myVar);
        //if ($("#status11").text() == 'RS1') {
            
            $("#mtime").val(time);
        //}
    }
    );

});            