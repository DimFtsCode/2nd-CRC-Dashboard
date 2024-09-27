$(document).ready(function () {
    
    $("#form_edit_secdata_asma").submit(function (e) {
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
        var $SecDAta = $('#mySecData').val();

        var data = {
            myAsma: $asma
        };
        
        var data1 = {
            mySecData: $SecDAta
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
            url: '../php_functions/security_select.php',
            type: 'post',
            data: data1,
            dataType: 'JSON',
            success: function (response) {
                $("#secid").val(response.secid);
                $("#cardno").val(response.cardno);
                $("#expdate").val(response.expdate);
                $("#seclevel").val(response.seclevel);
                $("#access").val(response.access);
                $("#clearance").val(response.clearance);
                $("#expclear").val(response.expclear);
                //alert(response.secid);
            }
            
        });
    };

