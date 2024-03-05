$(document).ready(function () {
    
    $("#form_edit_major").submit(function (e) {
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


window.onload = function () {
         //document.getElementById("asma").setAttribute("readonly", true);
        
        var $myMajor = $('#myMajor').val();

        var data = {
            myMajor: $myMajor
        };
        //alert($asma);  
        
        
        $.ajax({
            url: '../php_functions/major_select.php',
            type: 'post',
            data: data,
            dataType: 'JSON',
            success: function (response) {
                $("#mjid").val(response.mjid);
                $("#scope").val(response.scope);
                $("#type").val(response.type);
                $("#date_start").val(response.date_start);
                $("#date_end").val(response.date_end);
                $("#link").val(response.link);
                //alert(response.mjid);
            }
            
        });
       //alert(response.mjid);
    };

