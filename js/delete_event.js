$(document).ready(function () {
    
    $("#form_edit_event").submit(function (e) {
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
        
        var $asma = $('#userAsma').val();
        var $event = $('#myEvent').val();

        var data = {
            myAsma: $asma
        };
        
        var data1 = {
            myEvent: $event
        };
        //alert($asma);    
        $.ajax({
            url: '../php_functions/personnel_select.php',
            type: 'post',
            data: data,
            dataType: 'JSON',
            success: function (response) {
                $("#asma").val(response.asma);
                $("#rank").val(response.rank);
                $("#specialty").val(response.specialty);
                $("#last_name").val(response.last_name);
                $("#first_name").val(response.first_name);             
            }

        });
        
        //alert($event);  
        $.ajax({
            url: '../php_functions/event_select.php',
            type: 'post',
            data: data1,
            dataType: 'JSON',
            success: function (response) {
                $("#evid").val(response.evid);
                $("#type").val(response.type);
                $("#descript").val(response.descript);
                $("#date_start").val(response.date_start);
                $("#date_end").val(response.date_end);
                $("#doc").val(response.doc);
            }

        });
    };

